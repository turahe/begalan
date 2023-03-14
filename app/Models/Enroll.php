<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Enroll
 *
 * @property int $id
 * @property int $course_id
 * @property int $user_id
 * @property string|null $course_price
 * @property int|null $payment_id
 * @property string|null $status
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll query()
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereCoursePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enroll whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Enroll extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
