<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\QuestionOption
 *
 * @property int $id
 * @property null|int $question_id
 * @property null|string $title
 * @property null|int $image_id
 * @property null|string $d_pref
 * @property null|int $is_correct
 * @property null|int $sort_order
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereDPref($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereIsCorrect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereTitle($value)
 * @mixin \Eloquent
 */
class QuestionOption extends Model
{
    protected $guarded = [];
    public $timestamps = false;
}
