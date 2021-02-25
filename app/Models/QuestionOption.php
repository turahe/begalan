<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\QuestionOption.
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereUpdatedAt($value)
 */
class QuestionOption extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
