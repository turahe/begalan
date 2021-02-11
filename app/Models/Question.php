<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $quiz_id
 * @property string|null $title
 * @property int|null $image_id
 * @property string|null $type
 * @property string|null $score
 * @property int|null $sort_order
 * @property-read mixed $image_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuestionOption[] $options
 * @property-read int|null $options_count
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUserId($value)
 * @mixin \Eloquent
 */
class Question extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];
    public $timestamps = false;



    public function options()
    {
        return $this->hasMany(QuestionOption::class)->orderBy('sort_order', 'asc');
    }

    public function getImageUrlAttribute()
    {
        return media_image_uri($this->media);
    }

    public function delete_sync()
    {
        $this->options()->delete();
        $this->delete();
    }
}
