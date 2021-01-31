<?php

namespace App\Models;

use App\Services\Libraries\Slug\HasSlug;
use App\Services\Libraries\Slug\SlugOptions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Content extends Model
{
    use HasFactory;
    use HasSlug;
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        // TODO: Implement getSlugOptions() method.
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class)->with('sections', 'sections.items');
    }

    /**
     * @return BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'quiz_id')
            ->with('media')
            ->orderBy('sort_order', 'asc');
    }

    /**
     * @return HasMany
     */
    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class, 'quiz_id');
    }

    /**
     * @param null $key
     * @return null|mixed
     *
     * Get Attached Video Info
     */
    public function video_info($key = null)
    {
        $video_info = null;
        if ($this->video_src) {
            $video_info = json_decode($this->video_src, true);
        }
        if ($key && is_array($video_info)) {
            return array_get($video_info, $key);
        }

        return $video_info;
    }

    /**
     * @return null|string
     */
    public function getUrlAttribute()
    {
        if ($this->item_type === 'lecture') {
            return route('single_lecture', [$this->course_id, $this->id]);
        }
        if ($this->item_type === 'assignment') {
            return route('single_assignment', [$this->course_id, $this->id]);
        }
        if ($this->item_type === 'quiz') {
            return route('single_quiz', [$this->course_id, $this->id]);
        }

        return null;
    }

    /**
     * @return float|int
     */
    public function getRuntimeSecondsAttribute(): int
    {
        $hours = (int) $this->video_info('runtime.hours') * 3600;
        $mins = (int) $this->video_info('runtime.mins') * 60;
        $secs = (int) $this->video_info('runtime.secs');

        return $hours + $mins + $secs;
    }

    /**
     * @return false|string
     */
    public function getRuntimeAttribute()
    {
        $seconds = $this->runtime_seconds;
        if ($seconds) {
            return seconds_to_time_format($this->runtime_seconds);
        }

        return false;
    }

    /**
     * @param null $key
     * @param null $default
     * @return null|mixed
     */
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

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    /**
     * @return string
     */
    public function getIconHtmlAttribute()
    {
        $icon_class = 'file-text';

        if ($this->video_src) {
            $icon_class = 'youtube';
        }
        if ($this->item_type === 'assignment') {
            $icon_class = 'clipboard';
        }
        if ($this->item_type === 'quiz') {
            $icon_class = 'tasks';
        }

        return "<i class='la la-{$icon_class}'></i> ";
    }

    /**
     * @param int $user_id
     * @return HasOne
     */
    public function has_submission($user_id = 0)
    {
        if (! $user_id && Auth::check()) {
            $user_id = Auth::user()->id;
        }

        return $this->hasOne(AssignmentSubmission::class, 'assignment_id')->where('user_id', $user_id);
    }

    /**
     * @return HasMany
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(AssignmentSubmission::class, 'assignment_id');
    }

    /**
     * @return HasOne
     */
    public function previous(): HasOne
    {
        return $this->hasOne(self::class, 'course_id', 'course_id')
            ->where('sort_order', $this->sort_order - 1)
            ->orderBy('sort_order', 'desc');
    }

    /**
     * @return HasOne
     */
    public function next()
    {
        return $this->hasOne(self::class, 'course_id', 'course_id')
            ->where('sort_order', $this->sort_order + 1)
            ->orderBy('sort_order', 'asc');
    }

    /**
     * @return false
     */
    public function is_completed()
    {
        if (Auth::user()) {
            $user_id = Auth::user()->id;

            return $this->hasOne(Complete::class)
                ->whereUserId($user_id);
        }

        return false;
    }

    /**
     * @param array $data
     * @return $this
     *
     * Save content and sync to all necessary place
     */
    public function save_and_sync($data = [])
    {
        if (is_array($data) && count($data)) {
            $data['video_time'] = $this->runtime_seconds;
            $this->update($data);
        } else {
            $this->video_time = $this->runtime_seconds;
            $this->save();
        }

        $this->course->sync_everything();

        return $this;
    }

    /**
     * Content Drip.
     */
    public function enrolled_course()
    {
        if (! Auth::check()) {
            return null;
        }

        $user_id = Auth::check();

        return $this->hasOne(Enroll::class, 'course_id', 'course_id')
            ->where('user_id', $user_id)
            ->where('status', 'success');
    }

    /**
     * @return object
     */
    public function getDripAttribute()
    {
        $section_drip = $this->section->drip;

        $data = [
            'is_lock' => false,
            'message' => null,
        ];

        /*
         * If Section is Lock
         */
        if ($section_drip->is_lock) {
            $data['is_lock'] = true;
            $data['message'] = $section_drip->message;

            return (object) $data;
        }

        /**
         * If Lock by date.
         */
        $time = Carbon::now()->timestamp;

        if ($this->unlock_date && strtotime($this->unlock_date) > $time) {
            $unlock_date = Carbon::parse($this->unlock_date)->format(get_option('date_format'));

            $data['is_lock'] = true;
            $data['message'] = ' The content will become available at '.$unlock_date;
        }

        /*
         * If Lock by Days
         */
        if ($this->unlock_days && $this->unlock_days > 0) {
            if (Auth::check()) {
                $user = Auth::user();

                $isEnrol = $user->isEnrolled($this->course_id);
                $unlock_date = Carbon::parse($isEnrol->enrolled_at)->addDays($this->unlock_days);
                $now = Carbon::now();

                if ($unlock_date->gt($now)) {
                    $diffDays = $unlock_date->diffInDays($now);
                    $data['is_lock'] = true;
                    $data['message'] = "The content will become available in {$diffDays} days";
                }
            }
        }

        return (object) $data;
    }

    /**
     * @return HasMany
     */
    public function discussions(): HasMany
    {
        return $this->hasMany(Discussion::class)
            ->with('user', 'replies', 'user.photo_query')
            ->where('discussion_id', 0);
    }
}
