<?php

namespace App\Models;

use App\Contracts\Sortable;
use App\Services\Slug\HasSlug;
use App\Services\Slug\SlugOptions;
use App\Services\SortableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $parent_id
 * @property int|null $order_column
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read string $bg_color
 * @property-read string $url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read Category|null $parent_category
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[] $sub_categories
 * @property-read int|null $sub_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Query\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Category parent()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Category withoutTrashed()
 * @mixin \Eloquent
 */
class Category extends Model implements HasMedia, Sortable
{
    use HasSlug;
    use HasFactory;
    use SoftDeletes;
    use SortableTrait;
    use InteractsWithMedia;
    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        // TODO: Implement getSlugOptions() method.
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    /**
     * Generate url category by
     * call category->url.
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('category.view', $this);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeParent($query)
    {
        return $query->where('parent_id', 0)->orWhere('parent_id', null);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        $foreignKey = 'parent_id';
        if (! $this->parent_id) {
            $foreignKey = 'parent_category_id';
        } elseif ($this->parent_id == 1) {
            $foreignKey = 'second_category_id';
        }

        return $this->hasMany(Course::class, $foreignKey)
            ->orderBy('created_at', 'desc');
    }

    /**
     * @return string
     */
    public function categoryNameParent()
    {
        $parent_id = $this->parent_id;
        $category_name = '';

        if ($parent_id) {
            $parent_category_names = [];
            while ($parent_id) {
                $category = DB::table('categories')->whereId($parent_id)->first();
                $parent_id = $category->category_id;
                $parent_category_names[] = $category->name;
            }
            //krsort($parent_category_names);
            $category_name .= ' → '.implode(' → ', $parent_category_names);
        }

        return $category_name;
    }

    /**
     * @return string
     */
    public function getCategoryNameParent()
    {
        $category_name = $this->name.$this->categoryNameParent();

        return $category_name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_categories()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent_category()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    /**
     * @return string
     */
    public function getBgColorAttribute()
    {
        $bg_color = '#303'.substr(md5($this->category_name), 0, 3);

        return $bg_color;
    }
}
