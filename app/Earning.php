<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Earning
 *
 * @property int $id
 * @property null|int $instructor_id
 * @property null|int $course_id
 * @property null|int $payment_id
 * @property null|string $payment_status
 * @property null|string $amount
 * @property null|string $instructor_amount
 * @property null|string $admin_amount
 * @property null|string $instructor_share
 * @property null|string $admin_share
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property-read null|\App\Course $course
 * @property-read null|\App\Payment $payment
 * @method static \Illuminate\Database\Eloquent\Builder|Earning newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Earning newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Earning query()
 * @method static \Illuminate\Database\Eloquent\Builder|Earning whereAdminAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Earning whereAdminShare($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Earning whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Earning whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Earning whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Earning whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Earning whereInstructorAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Earning whereInstructorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Earning whereInstructorShare($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Earning wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Earning wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Earning whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Earning extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
}
