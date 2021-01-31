<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QuestionOption
 *
 * @property int $id
 * @property int|null $question_id
 * @property string|null $title
 * @property int|null $image_id
 * @property string|null $d_pref
 * @property int|null $is_correct
 * @property int|null $sort_order
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
