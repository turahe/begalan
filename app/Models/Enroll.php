<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Enroll
 *
 * @property int $id
 * @property int|null $course_id
 * @property int|null $user_id
 * @property string|null $course_price
 * @property int|null $payment_id
 * @property string|null $status
 * @property string|null $enrolled_at
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll query()
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereCoursePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereEnrolledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereUserId($value)
 * @mixin \Eloquent
 */
class Enroll extends Model
{
    //
}
