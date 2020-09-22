<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Section
 *
 * @property int $id
 * @property null|int $course_id
 * @property null|string $section_name
 * @property null|string $unlock_date
 * @property null|int $unlock_days
 * @property null|int $sort_order
 * @property-read null|\App\Course $course
 * @property-read mixed $drip
 * @property-read \App\Content[]|\Illuminate\Database\Eloquent\Collection $items
 * @property-read null|int $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUnlockDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUnlockDays($value)
 * @mixin \Eloquent
 */
class Section extends Model
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
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        if (Auth::check()) {
            return $this->hasMany(Content::class)
                ->orderBy('sort_order', 'asc')
                ->with('is_completed');
        }
        return $this->hasMany(Content::class)
            ->orderBy('sort_order', 'asc');
    }

    /**
     * @return object
     */
    public function getDripAttribute()
    {
        $data = [
            'is_lock' => false,
            'message' => null,
        ];

        $time = Carbon::now()->timestamp;

        if ($this->unlock_date && strtotime($this->unlock_date) > $time) {
            $unlock_date = Carbon::createFromTimeString($this->unlock_date)->format(get_option('date_format'));

            $data['is_lock'] = true;
            $data['message'] = ' The content will become available at '.$unlock_date;
        }

        /**
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
}
