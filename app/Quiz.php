<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Quiz
 *
 * @property int $id
 * @property null|int $user_id
 * @property null|int $course_id
 * @property null|int $section_id
 * @property null|string $title
 * @property null|string $slug
 * @property null|string $text
 * @property null|string $video_src
 * @property null|int $video_time
 * @property null|string $item_type
 * @property null|int $is_preview
 * @property null|int $status
 * @property null|int $sort_order
 * @property null|string $options
 * @property null|int $quiz_gradable
 * @property null|string $unlock_date
 * @property null|int $unlock_days
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property-read \App\Attempt[]|\Illuminate\Database\Eloquent\Collection $attempts
 * @property-read null|int $attempts_count
 * @property-read mixed $url
 * @property-read \App\Question[]|\Illuminate\Database\Eloquent\Collection $questions
 * @property-read null|int $questions_count
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

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id')->with('media');
    }
    public function attempts()
    {
        return $this->hasMany(Attempt::class, 'quiz_id');
    }
    public function option($key = null, $default = null)
    {
        $options = null;
        if ($this->options) {
            $options = json_decode($this->options, true);
        }
        if ($key) {
            if (is_array($options) && array_get($options, $key)) {
                return array_get($options, $key);
            }
            return $default;
        }

        return $options;
    }

    public function getUrlAttribute()
    {
        return route('single_quiz', [$this->course_id, $this->id]);
    }
}
