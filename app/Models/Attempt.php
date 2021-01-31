<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Attempt.
 *
 * @property int $id
 * @property int|null $course_id
 * @property int|null $quiz_id
 * @property int|null $user_id
 * @property int|null $reviewer_id
 * @property int|null $questions_limit
 * @property int|null $total_answered
 * @property string|null $total_scores
 * @property string|null $earned_scores
 * @property int|null $passing_percent
 * @property int|null $earned_percent
 * @property string|null $status
 * @property int|null $quiz_gradable
 * @property int|null $is_reviewed
 * @property \Illuminate\Support\Carbon|null $ended_at
 * @property string|null $reviewed_at
 * @property int|null $passed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Answer[] $answers
 * @property-read int|null $answers_count
 * @property-read \App\Models\Course|null $course
 * @property-read string $status_html
 * @property-read \App\Models\Content|null $quiz
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereEarnedPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereEarnedScores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereEndedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereIsReviewed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt wherePassed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt wherePassingPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereQuestionsLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereQuizGradable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereReviewedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereReviewerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereTotalAnswered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereTotalScores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereUserId($value)
 * @mixin \Eloquent
 */
class Attempt extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $dates = ['ended_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class)->with('question');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz()
    {
        return $this->belongsTo(Content::class, 'quiz_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * @return string
     */
    public function getStatusHtmlAttribute()
    {
        $statusClass = '';
        $iclass = '';
        switch ($this->status) {
            case 'started':
                $statusClass .= 'dark';
                $iclass = 'clock-o';
                break;
            case 'in_review':
                $statusClass .= 'warning';
                $iclass = 'hourglass';
                break;
            case 'finished':
                $statusClass .= 'success';
                $iclass = 'check-circle';
                break;
        }

        $html = "<span class='badge payment-status-{$this->status} badge-{$statusClass}'> <i class='la la-{$iclass}'></i> {$this->status}</span>";

        return $html;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function save_and_sync($data = [])
    {
        if (is_array($data) && count($data)) {
            $this->update($data);
        } else {
            $this->save();
        }

        $q_score = $this->answers->sum('q_score');
        $r_score = $this->answers->sum('r_score');

        $earned_percent = 0;
        if ($r_score > 0) {
            $earned_percent = (100 * $r_score) / $q_score;
        }

        $passing_percent = (int) $this->quiz->option('passing_score');

        $passed = $earned_percent >= $passing_percent ? 1 : 0;

        $this->earned_scores = $r_score;
        $this->earned_percent = $earned_percent;
        $this->passed = $passed;
        $this->save();

        $content = Content::find($this->quiz_id);
        complete_content($content, $this->user);

        return $this;
    }
}
