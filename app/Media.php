<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Media
 *
 * @property int $id
 * @property null|int $user_id
 * @property null|string $name
 * @property null|string $title
 * @property null|string $alt_text
 * @property null|string $slug
 * @property null|string $slug_ext
 * @property null|string $file_size
 * @property null|string $mime_type
 * @property null|string $metadata
 * @property null|int $sort_order
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property-read mixed $media_info
 * @property-read mixed $readable_size
 * @property-read mixed $thumbnail
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereAltText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSlugExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUserId($value)
 * @mixin \Eloquent
 */
class Media extends Model
{
    protected $guarded = [];
    protected $table = 'media';

    public function getMediaInfoAttribute()
    {
        $url_path = null;
        $source = get_option('default_storage');

        $slug_ext = $this->slug_ext;
        if (substr($this->mime_type, 0, 5) == 'image') {
            $slug_ext = 'images/'.$slug_ext;
        }

        if ($source == 'public') {
            $url_path = asset("uploads/".$slug_ext);
        } elseif ($source == 's3') {
            $url_path = \Illuminate\Support\Facades\Storage::disk('s3')->url("uploads/".$slug_ext);
        }

        $info = [
            'ID'            => $this->id,
            'name'          => $this->name,
            'title'         => $this->title,
            'alt_text'      => $this->alt_text,
            'slug_ext'      => $this->slug_ext,
            'size'          => $this->formatBytes(),
            'mime_type'     => $this->mime_type,
            'url'           => $url_path,
            'thumbnail'           => $url_path,
            'uploaded_at'   => $this->created_at->format(get_option('date_format')),
        ];


        if (substr($this->mime_type, 0, 5) !== 'image') {
            $info['thumbnail'] = $this->thumbnail;
        }


        return $info;
    }


    /**
     * Format bytes to kb, mb, gb, tb
     *
     * @param  integer $precision
     * @return integer
     */
    public function formatBytes($precision = 2)
    {
        $size = $this->file_size;

        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = [' bytes', ' KB', ' MB', ' GB', ' TB'];

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }
        return $size;
    }

    public function getReadableSizeAttribute()
    {
        return $this->formatBytes();
    }

    public function getThumbnailAttribute()
    {
        $thumbnail_url = asset('uploads/placeholder-image.png');
        if (substr($this->mime_type, 0, 5) == 'image') {
            $thumbnail_url = media_image_uri($this)->thumbnail;
        }
        if (substr($this->mime_type, 0, 5) == 'video') {
            $thumbnail_url = asset('uploads/video.png');
        }
        return $thumbnail_url;
    }
}
