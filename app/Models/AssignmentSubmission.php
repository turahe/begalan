<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\AssignmentSubmission.
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $assignment_id
 * @property int $instructor_id
 * @property string|null $text_submission
 * @property string|null $earned_numbers
 * @property string|null $instructors_note
 * @property string|null $status
 * @property int|null $is_evaluated
 * @property \Illuminate\Support\Carbon|null $evaluated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Content $assignment
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\User $instructor
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User $student
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereAssignmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereEarnedNumbers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereEvaluatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereInstructorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereInstructorsNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereIsEvaluated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereTextSubmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereUserId($value)
 * @mixin \Eloquent
 */
class AssignmentSubmission extends Model implements HasMedia
{
    use InteractsWithMedia;
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $casts = [
        'evaluated_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'assignment_id');
    }

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * @return BelongsTo
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
