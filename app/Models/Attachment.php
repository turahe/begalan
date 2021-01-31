<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
