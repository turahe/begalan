<?php

namespace App\Models;

use App\Contracts\Sortable;
use App\Services\SortableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Section.
 *
 * @property int $id
 * @property int|null $course_id
 * @property string|null $section_name
 * @property string|null $unlock_date
 * @property int|null $unlock_days
 * @property int|null $sort_order
 * @property-read \App\Models\Course|null $course
 * @property-read object $drip
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Content[] $items
 * @property-read int|null $items_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUnlockDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUnlockDays($value)
 *
 * @mixin \Eloquent
 *
 * @property string $name
 * @property int $order_column
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Section ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUpdatedAt($value)
 */
class Section extends Model implements Sortable
{
    use SortableTrait;
    use HasFactory;

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function items(): HasMany
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
}
