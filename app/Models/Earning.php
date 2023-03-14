<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Earning.
 *
 * @property int $id
 * @property int|null $instructor_id
 * @property int|null $course_id
 * @property int|null $payment_id
 * @property string|null $payment_status
 * @property string|null $amount
 * @property string|null $instructor_amount
 * @property string|null $admin_amount
 * @property string|null $instructor_share
 * @property string|null $admin_share
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course|null $course
 * @property-read \App\Models\Payment|null $payment
 *
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
 *
 * @mixin \Eloquent
 */
class Earning extends Model
{
    protected $guarded = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
}
