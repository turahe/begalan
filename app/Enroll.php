<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Enroll
 *
 * @property int $id
 * @property null|int $course_id
 * @property null|int $user_id
 * @property null|string $course_price
 * @property null|int $payment_id
 * @property null|string $status
 * @property null|string $enrolled_at
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
