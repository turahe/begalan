<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Answer
 *
 * @property int $id
 * @property int|null $quiz_id
 * @property int|null $question_id
 * @property int|null $user_id
 * @property int|null $attempt_id
 * @property string|null $answer
 * @property string|null $q_type
 * @property string|null $q_score
 * @property string|null $r_score
 * @property int|null $is_correct
 * @property-read \App\Question|null $question
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
    public function question(){
        return $this->belongsTo(Question::class, 'question_id');
    }
}
