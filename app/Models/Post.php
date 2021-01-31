<?php

namespace App\Models;

use App\Services\Libraries\Slug\HasSlug;
use App\Services\Libraries\Slug\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $post_content
 * @property int|null $feature_image
 * @property string|null $type
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $author
 * @property-read string $published_time
 * @property-read string $status_context
 * @property-read object $thumbnail_url
 * @property-read string $url
 * @property-read \App\Models\Media|null $media
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
    use HasFactory;
    use HasSlug;
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        // TODO: Implement getSlugOptions() method.
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

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
        $statusClass = '';
        $iclass = '';
        $status = __a('pending');
        switch ($this->status) {
            case '0':
                $statusClass .= 'dark';
                $iclass = 'clock-o';
                break;
            case '1':
                $statusClass .= 'success';
                $iclass = 'check-circle';
                $status = __a('published');
                break;
            case '2':
                $statusClass .= 'danger';
                $iclass = 'exclamation-circle';
                $status = __a('unpublished');
                break;
        }

        $html = "<span class='badge post-status-{$this->status} badge-{$statusClass}'> <i class='la la-{$iclass}'></i> {$status}</span>";

        return $html;
    }
}
