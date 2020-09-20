<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AssignmentSubmission
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $course_id
 * @property int|null $assignment_id
 * @property int|null $instructor_id
 * @property string|null $text_submission
 * @property string|null $earned_numbers
 * @property string|null $instructors_note
 * @property string|null $status
 * @property int|null $is_evaluated
 * @property \Illuminate\Support\Carbon|null $evaluated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Content|null $assignment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \App\Course|null $course
 * @property-read \App\User|null $instructor
 * @property-read \App\User|null $student
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
class AssignmentSubmission extends Model
{
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments(){
        return $this->hasMany(Attachment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(){
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignment(){
        return $this->belongsTo(Content::class, 'assignment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instructor(){
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
