<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Post
 *
 * @property int $id
 * @property null|int $user_id
 * @property null|string $title
 * @property null|string $slug
 * @property null|string $post_content
 * @property null|int $feature_image
 * @property null|string $type
 * @property null|string $status
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property-read null|\App\User $author
 * @property-read mixed $published_time
 * @property-read mixed $status_context
 * @property-read mixed $thumbnail_url
 * @property-read mixed $url
 * @property-read null|\App\Media $media
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post post()
 * @method static \Illuminate\Database\Eloquent\Builder|Post publish()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereFeatureImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublish($query)
    {
        return $query->where('status', 1)->orderBy('created_at', 'desc');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePost($query)
    {
        return $query->where('type', 'post')->with('media', 'author');
    }

    /**
     * @return string
     */
    public function getPublishedTimeAttribute()
    {
        return $this->created_at->format(date_time_format());
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('post', $this->slug);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media()
    {
        return $this->belongsTo(Media::class, 'feature_image');
    }

    /**
     * @return object
     */
    public function getThumbnailUrlAttribute()
    {
        return media_image_uri($this->media);
    }

    /**
     * @return string
     */
    public function getStatusContextAttribute()
    {
        $statusClass = "";
        $iclass = "";
        $status = __a('pending');
        switch ($this->status) {
            case '0':
                $statusClass .= "dark";
                $iclass = "clock-o";
                break;
            case '1':
                $statusClass .= "success";
                $iclass = "check-circle";
                $status = __a('published');
                break;
            case '2':
                $statusClass .= "danger";
                $iclass = "exclamation-circle";
                $status = __a('unpublished');
                break;
        }

        $html = "<span class='badge post-status-{$this->status} badge-{$statusClass}'> <i class='la la-{$iclass}'></i> {$status}</span>";
        return $html;
    }
}
