<?php

namespace App\Models;

use App\Services\Libraries\Slug\HasSlug;
use App\Services\Libraries\Slug\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
