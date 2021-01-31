<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use InvalidArgumentException;

/**
 * Trait HasTags.
 */
trait HasTags
{
    /**
     * @var array
     */
    protected array $queuedTags = [];

    public static function bootHasTags()
    {
        static::created(function (Model $taggableModel) {
            if (count($taggableModel->queuedTags) > 0) {
                $taggableModel->attachTags($taggableModel->queuedTags);

                $taggableModel->queuedTags = [];
            }
        });

        static::deleted(function (Model $deletedModel) {
            $tags = $deletedModel->tags()->get();

            $deletedModel->detachTags($tags);
        });
    }

    /**
     * @return MorphToMany
     */
    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(Tag::class, 'taggable')
            ->ordered();
    }

    /**
     * @param $tags
     */
    public function setTagsAttribute($tags)
    {
        if (! $this->exists) {
            $this->queuedTags = $tags;

            return;
        }

        $this->syncTags($tags);
    }

    /**
     * @param Builder $query
     * @param $tags
     * @param string|null $type
     * @return Builder
     */
    public function scopeWithAllTags(Builder $query, $tags, string $type = null): Builder
    {
        $tags = static::convertToTags($tags, $type);

        collect($tags)->each(function ($tag) use ($query) {
            $query->whereHas('tags', function (Builder $query) use ($tag) {
                $query->where('tags.id', $tag ? $tag->id : 0);
            });
        });

        return $query;
    }

    /**
     * @param Builder $query
     * @param $tags
     * @param string|null $type
     * @return Builder
     */
    public function scopeWithAnyTags(Builder $query, $tags, string $type = null): Builder
    {
        $tags = static::convertToTags($tags, $type);

        return $query->whereHas('tags', function (Builder $query) use ($tags) {
            $tagIds = collect($tags)->pluck('id');

            $query->whereIn('tags.id', $tagIds);
        });
    }

    /**
     * @param Builder $query
     * @param $tags
     * @return Builder
     */
    public function scopeWithAllTagsOfAnyType(Builder $query, $tags): Builder
    {
        $tags = static::convertToTagsOfAnyType($tags);

        collect($tags)->each(function ($tag) use ($query) {
            $query->whereHas('tags', function (Builder $query) use ($tag) {
                $query->where('tags.id', $tag ? $tag->id : 0);
            });
        });

        return $query;
    }

    /**
     * @param Builder $query
     * @param $tags
     * @return Builder
     */
    public function scopeWithAnyTagsOfAnyType(Builder $query, $tags): Builder
    {
        $tags = static::convertToTagsOfAnyType($tags);

        return $query->whereHas('tags', function (Builder $query) use ($tags) {
            $tagIds = collect($tags)->pluck('id');

            $query->whereIn('tags.id', $tagIds);
        });
    }

    /**
     * @param string|null $type
     * @return Collection
     */
    public function tagsWithType(string $type = null): Collection
    {
        return $this->tags->filter(function (Tag $tag) use ($type) {
            return $tag->type === $type;
        });
    }

    /**
     * @param $tags
     * @param string|null $type
     * @return $this
     */
    public function attachTags($tags, string $type = null)
    {
        $tags = collect(Tag::findOrCreate($tags, $type));

        $this->tags()->syncWithoutDetaching($tags->pluck('id')->toArray());

        return $this;
    }

    /**
     * @param $tag
     * @param string|null $type
     * @return HasTags
     */
    public function attachTag($tag, string $type = null)
    {
        return $this->attachTags([$tag], $type);
    }

    /**
     * @param array|\ArrayAccess $tags
     *
     * @param string|null $type
     * @return $this
     */
    public function detachTags($tags, string $type = null)
    {
        $tags = static::convertToTags($tags, $type);

        collect($tags)
            ->filter()
            ->each(function (Tag $tag) {
                $this->tags()->detach($tag);
            });

        return $this;
    }

    /**
     * @param $tag
     * @param string|null $type
     * @return HasTags
     */
    public function detachTag($tag, string $type = null)
    {
        return $this->detachTags([$tag], $type);
    }

    /**
     * @param array|\ArrayAccess $tags
     *
     * @return $this
     */
    public function syncTags($tags)
    {
        $tags = collect(Tag::findOrCreate($tags));

        $this->tags()->sync($tags->pluck('id')->toArray());

        return $this;
    }

    /**
     * @param array|\ArrayAccess $tags
     * @param string|null $type
     *
     * @return $this
     */
    public function syncTagsWithType($tags, string $type = null)
    {
        $tags = collect(Tag::findOrCreate($tags, $type));

        $this->syncTagIds($tags->pluck('id')->toArray(), $type);

        return $this;
    }

    /**
     * @param $values
     * @param null $type
     * @return \Illuminate\Support\Collection
     */
    protected static function convertToTags($values, $type = null)
    {
        return collect($values)->map(function ($value) use ($type) {
            if ($value instanceof Tag) {
                if (isset($type) && $value->type != $type) {
                    throw new InvalidArgumentException("Type was set to {$type} but tag is of type {$value->type}");
                }

                return $value;
            }

            return Tag::findFromString($value, $type);
        });
    }

    /**
     * @param $values
     * @return \Illuminate\Support\Collection
     */
    protected static function convertToTagsOfAnyType($values)
    {
        return collect($values)->map(function ($value) {
            if ($value instanceof Tag) {
                return $value;
            }

            return Tag::findFromStringOfAnyType($value);
        });
    }

    /**
     * Use in place of eloquent sync() method so that the tag type may be optionally specified.
     *
     * @param $ids
     * @param string|null $type
     * @param bool $detaching
     */
    protected function syncTagIds($ids, string $type = null, $detaching = true)
    {
        $isUpdated = false;

        // Get a list of tag_ids for all current tags
        $current = $this->tags()
            ->newPivotStatement()
            ->where('taggable_id', $this->getKey())
            ->where('taggable_type', $this->getMorphClass())
            ->when($type !== null, function ($query) use ($type) {
                $tagModel = $this->tags()->getRelated();

                return $query->join(
                    $tagModel->getTable(),
                    'taggables.tag_id',
                    '=',
                    $tagModel->getTable().'.'.$tagModel->getKeyName()
                )
                    ->where('tags.type', $type);
            })
            ->pluck('tag_id')
            ->all();

        // Compare to the list of ids given to find the tags to remove
        $detach = array_diff($current, $ids);
        if ($detaching && count($detach) > 0) {
            $this->tags()->detach($detach);
            $isUpdated = true;
        }

        // Attach any new ids
        $attach = array_unique(array_diff($ids, $current));
        if (count($attach) > 0) {
            collect($attach)->each(function ($id) {
                $this->tags()->attach($id, []);
            });
            $isUpdated = true;
        }

        // Once we have finished attaching or detaching the records, we will see if we
        // have done any attaching or detaching, and if we have we will touch these
        // relationships if they are configured to touch on any database updates.
        if ($isUpdated) {
            $this->tags()->touchIfTouching();
        }
    }
}
