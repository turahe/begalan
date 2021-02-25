<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Complete
 *
 * @property int $id
 * @property int $user_id
 * @property int $completed_course_id
 * @property int $course_id
 * @property int $content_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Complete newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Complete newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Complete query()
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereCompletedCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complete whereUserId($value)
 * @mixin \Eloquent
 */
class Complete extends Model
{
    protected $dates = ['completed_at'];

}
