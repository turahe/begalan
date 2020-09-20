<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Complete
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $completed_course_id
 * @property int|null $course_id
 * @property int|null $content_id
 * @property \Illuminate\Support\Carbon $completed_at
 * @method static \Illuminate\Database\Eloquent\Builder|Complete newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Complete newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Complete query()
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereCompletedCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereUserId($value)
 * @mixin \Eloquent
 */
class Complete extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * @var string[]
     */
    protected $dates = ['completed_at'];
    /**
     * @var bool
     */
    public $timestamps = false;
}
