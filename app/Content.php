<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\Content
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attempt[] $attempts
 * @property-read int|null $attempts_count
 * @property-read \App\Course|null $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Discussion[] $discussions
 * @property-read int|null $discussions_count
 * @property-read mixed $drip
 * @property-read mixed $icon_html
 * @property-read mixed $runtime
 * @property-read mixed $runtime_seconds
 * @property-read mixed $url
 * @property-read Content|null $next
 * @property-read Content|null $previous
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $questions
 * @property-read int|null $questions_count
 * @property-read \App\Section|null $section
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AssignmentSubmission[] $submissions
 * @property-read int|null $submissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content query()
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereIsPreview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereItemType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereQuizGradable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUnlockDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUnlockDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereVideoSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereVideoTime($value)
 * @mixin \Eloquent
 */
class Content extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(){
        return $this->belongsTo(Course::class)->with('sections', 'sections.items');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section(){
        return $this->belongsTo(Section::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(){
        return $this->hasMany(Question::class, 'quiz_id')->with('media')->orderBy('sort_order', 'asc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attempts(){
        return $this->hasMany(Attempt::class, 'quiz_id');
    }

    /**
     * @param null $key
     * @return mixed|null
     *
     * Get Attached Video Info
     */

    public function video_info($key = null){
        $video_info = null;
        if ($this->video_src){
            $video_info = json_decode($this->video_src, true);
        }
        if ($key && is_array($video_info)){
            return array_get($video_info, $key);
        }

        return $video_info;
    }

    /**
     * @return string|null
     */
    public function getUrlAttribute(){
        if ($this->item_type === 'lecture'){
            return route('single_lecture', [$this->course_id, $this->id]);
        }elseif ($this->item_type === 'assignment'){
            return route('single_assignment', [$this->course_id, $this->id]);
        }elseif ($this->item_type === 'quiz'){
            return route('single_quiz', [$this->course_id, $this->id]);
        }
        return null;
    }

    /**
     * @return float|int
     */
    public function getRuntimeSecondsAttribute(){
        $hours = (int) $this->video_info('runtime.hours') * 3600;
        $mins = (int) $this->video_info('runtime.mins') * 60;
        $secs = (int) $this->video_info('runtime.secs');

        return $hours + $mins + $secs;
    }

    /**
     * @return false|string
     */
    public function getRuntimeAttribute(){
        $seconds = $this->runtime_seconds;
        if ($seconds){
            return seconds_to_time_format($this->runtime_seconds);
        }
        return false;
    }

    /**
     * @param null $key
     * @param null $default
     * @return mixed|null
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments(){
        return $this->hasMany(Attachment::class);
    }

    /**
     * @return string
     */
    public function getIconHtmlAttribute(){
        $icon_class = 'file-text';

        if ($this->video_src){
            $icon_class = 'youtube';
        }
        if ($this->item_type === 'assignment'){
            $icon_class = 'clipboard';
        }
        if ($this->item_type === 'quiz'){
            $icon_class = 'tasks';
        }

        return "<i class='la la-{$icon_class}'></i> ";
    }

    /**
     * @param int $user_id
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function has_submission($user_id = 0){
        if ( ! $user_id && Auth::check()){
            $user_id = Auth::user()->id;
        }
        return $this->hasOne(AssignmentSubmission::class, 'assignment_id')->where('user_id', $user_id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions(){
        return $this->hasMany(AssignmentSubmission::class, 'assignment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function previous(){
        return $this->hasOne(Content::class, 'course_id', 'course_id')->where('sort_order', $this->sort_order-1)->orderBy('sort_order', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function next(){
        return $this->hasOne(Content::class, 'course_id', 'course_id')->where('sort_order', $this->sort_order+1)->orderBy('sort_order', 'asc');
    }

    /**
     * @return false
     */
    public function is_completed(){
        if (Auth::user()){
            $user_id = Auth::user()->id;
            return $this->hasOne(Complete::class)->whereUserId($user_id);
        }
        return false;
    }

    /**
     * @param array $data
     * @return $this
     *
     * Save content and sync to all necessary place
     */

    public function save_and_sync($data = []){
        if (is_array($data) && count($data)){
            $data['video_time'] = $this->runtime_seconds;
            $this->update($data);
        }else{
            $this->video_time = $this->runtime_seconds;
            $this->save();
        }

        $this->course->sync_everything();

        return $this;
    }


    /**
     * Content Drip
     */


    public function enrolled_course(){
        if ( ! Auth::check()){
            return null;
        }

        $user_id = Auth::check();
        return $this->hasOne(Enroll::class, 'course_id', 'course_id')->where('user_id', $user_id)->where('status', 'success');
    }

    /**
     * @return object
     */
    public function getDripAttribute(){
        $section_drip = $this->section->drip;

        $data = [
            'is_lock' => false,
            'message' => null,
        ];

        /**
         * If Section is Lock
         */
        if ($section_drip->is_lock){

            $data['is_lock'] = true;
            $data['message'] = $section_drip->message;

            return (object) $data;
        }

        /**
         * If Lock by date
         */

        $time = Carbon::now()->timestamp;

        if ($this->unlock_date && strtotime($this->unlock_date) > $time ){
            $unlock_date = Carbon::parse($this->unlock_date)->format(get_option('date_format'));

            $data['is_lock'] = true;
            $data['message'] = ' The content will become available at '.$unlock_date;
        }

        /**
         * If Lock by Days
         */
        if ($this->unlock_days && $this->unlock_days > 0 ){
            if (Auth::check()){
                $user = Auth::user();

                $isEnrol = $user->isEnrolled($this->course_id);
                $unlock_date = Carbon::parse($isEnrol->enrolled_at)->addDays($this->unlock_days);
                $now = Carbon::now();

                if ($unlock_date->gt($now)){
                    $diffDays = $unlock_date->diffInDays($now);
                    $data['is_lock'] = true;
                    $data['message'] = "The content will become available in {$diffDays} days";
                }
            }
        }

        return (object) $data;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discussions(){
        return $this->hasMany(Discussion::class)->with('user', 'replies', 'user.photo_query')->where('discussion_id', 0);
    }

}
