<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Answer
 *
 * @property int $id
 * @property null|int $quiz_id
 * @property null|int $question_id
 * @property null|int $user_id
 * @property null|int $attempt_id
 * @property null|string $answer
 * @property null|string $q_type
 * @property null|string $q_score
 * @property null|string $r_score
 * @property null|int $is_correct
 * @property-read null|\App\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder|Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereAttemptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereIsCorrect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereQScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereQType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereRScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereUserId($value)
 * @mixin \Eloquent
 */
class Answer extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
