<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Question
 *
 * @property int $id
 * @property null|int $user_id
 * @property null|int $quiz_id
 * @property null|string $title
 * @property null|int $image_id
 * @property null|string $type
 * @property null|string $score
 * @property null|int $sort_order
 * @property-read mixed $image_url
 * @property-read null|\App\Media $media
 * @property-read \App\QuestionOption[]|\Illuminate\Database\Eloquent\Collection $options
 * @property-read null|int $options_count
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
class Question extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function media()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }
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
