<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Attachment.
 *
 * @property int $id
 * @property int|null $course_id
 * @property int|null $belongs_course_id
 * @property int|null $content_id
 * @property int|null $user_id
 * @property int|null $media_id
 * @property string|null $hash_id
 * @property-read \App\Models\Content|null $belongs_item
 * @property-read \App\Models\Media|null $media
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereBelongsCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereHashId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereUserId($value)
 * @mixin \Eloquent
 */
class Attachment extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function belongs_item()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        if ($this->course_id) {
            return $this->belongsTo(Course::class, 'course_id');
        }
        if ($this->belongs_course_id) {
            return $this->belongsTo(Course::class, 'belongs_course_id');
        }
    }
}
