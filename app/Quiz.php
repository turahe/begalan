<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Quiz
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $course_id
 * @property int|null $section_id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $text
 * @property string|null $video_src
 * @property int|null $video_time
 * @property string|null $item_type
 * @property int|null $is_preview
 * @property int|null $status
 * @property int|null $sort_order
 * @property string|null $options
 * @property int|null $quiz_gradable
 * @property string|null $unlock_date
 * @property int|null $unlock_days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attempt[] $attempts
 * @property-read int|null $attempts_count
 * @property-read mixed $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereIsPreview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereItemType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereQuizGradable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereUnlockDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereUnlockDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereVideoSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereVideoTime($value)
 * @mixin \Eloquent
 */
class Quiz extends Model
{
    protected $table = 'contents';
    protected $guarded = [];

    public function questions(){
        return $this->hasMany(Question::class, 'quiz_id')->with('media');
    }
    public function attempts(){
        return $this->hasMany(Attempt::class, 'quiz_id');
    }
    public function option($key = null, $default = null){
        $options = null;
        if ($this->options){
            $options = json_decode($this->options, true);
        }
        if ($key){
            if (is_array($options) && array_get($options, $key)){
                return array_get($options, $key);
            }else{
                return $default;
            }
        }

        return $options;
    }

    public function getUrlAttribute(){
        return route('single_quiz', [$this->course_id, $this->id]);
    }

}
