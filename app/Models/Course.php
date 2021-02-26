<?php

namespace App\Models;

use App\Services\Rateable;
use App\Services\Slug\HasSlug;
use App\Services\Slug\SlugOptions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Turahe\Likeable\Contracts\Likeable as LikeableContract;
use Turahe\Likeable\Traits\Likeable;

/**
 * App\Models\Course.
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property string $slug
 * @property string|null $short_description
 * @property string|null $description
 * @property string|null $benefits
 * @property string|null $requirements
 * @property string|null $price_plan
 * @property string|null $price
 * @property string|null $sale_price
 * @property int $level
 * @property int|null $status
 * @property int|null $is_presale
 * @property string|null $launch_at
 * @property int|null $thumbnail_id
 * @property string|null $video_src
 * @property int|null $total_video_time
 * @property int|null $require_enroll
 * @property int|null $require_login
 * @property int|null $total_lectures
 * @property int|null $total_assignments
 * @property int|null $total_quiz
 * @property int|null $is_featured
 * @property string|null $featured_at
 * @property int|null $is_popular
 * @property string|null $popular_added_at
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AssignmentSubmission[] $assignment_submissions
 * @property-read int|null $assignment_submissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AssignmentSubmission[] $assignment_submissions_waiting
 * @property-read int|null $assignment_submissions_waiting_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Content[] $assignments
 * @property-read int|null $assignments_count
 * @property-read \App\Models\User $author
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Content[] $contents
 * @property-read int|null $contents_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Likeable\Models\Like[] $dislikes
 * @property-read int $dislikes_count
 * @property-read \Turahe\Likeable\Models\LikeCounter|null $dislikesCounter
 * @property-read mixed $average_rating
 * @property-read null|array $benefits_arr
 * @property-read null|string $continue_url
 * @property-read bool $disliked
 * @property-read array[] $drip_items
 * @property-read bool $free
 * @property-read null|int|string $get_price
 * @property-read bool $i_am_instructor
 * @property-read bool $liked
 * @property-read int|null $likes_count
 * @property-read int $likes_diff_dislikes_count
 * @property-read bool $paid
 * @property-read null|array $requirements_arr
 * @property-read mixed $sum_rating
 * @property-read string $url
 * @property-read mixed $user_average_rating
 * @property-read mixed $user_sum_rating
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $instructors
 * @property-read int|null $instructors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Content[] $lectures
 * @property-read int|null $lectures_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Likeable\Models\Like[] $likes
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Likeable\Models\Like[] $likesAndDislikes
 * @property-read int|null $likes_and_dislikes_count
 * @property-read \Turahe\Likeable\Models\LikeCounter|null $likesCounter
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attempt[] $quiz_attempts
 * @property-read int|null $quiz_attempts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Content[] $quizzes
 * @property-read int|null $quizzes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Rate[] $ratings
 * @property-read int|null $ratings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Section[] $sections
 * @property-read int|null $sections_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $students
 * @property-read int|null $students_count
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Query\Builder|Course onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Course orderByDislikesCount($direction = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|Course orderByLikesCount($direction = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|Course publish()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDislikedBy($userId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereFeaturedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereIsPopular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereIsPresale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereLaunchAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereLikedBy($userId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePopularAddedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePricePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereRequireEnroll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereRequireLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereThumbnailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTotalAssignments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTotalLectures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTotalQuiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTotalVideoTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereVideoSrc($value)
 * @method static \Illuminate\Database\Query\Builder|Course withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Course withoutTrashed()
 * @mixin \Eloquent
 */
class Course extends Model implements HasMedia, LikeableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;
    use Rateable;
    use Likeable;
    use HasSlug;
    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * @var string[]
     */
    protected $casts = [
        'last_updated_at'   => 'datetime',
    ];

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
     * @param $query
     * @return mixed
     */
    public function scopePublish($query)
    {
        return $query->where('status', 1)->with('media', 'author', 'category');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsToMany
     */
    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrolls')
            ->where('status', 'success')
            ->withPivot('enrolled_at');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return HasMany
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('order_column', 'asc');
    }

    /**
     * @return HasMany
     */
    public function lectures(): HasMany
    {
        return $this->hasMany(Content::class)->where('item_type', 'lecture');
    }

    /**
     * @return HasMany
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(Content::class)->where('item_type', 'assignment');
    }

    /**
     * @return HasMany
     */
    public function quizzes(): HasMany
    {
        return $this->hasMany(Content::class)->where('item_type', 'quiz');
    }

    /**
     * @return HasMany
     */
    public function quiz_attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    /**
     * @return HasMany
     */
    public function assignment_submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    /**
     * @return HasMany
     */
    public function assignment_submissions_waiting()
    {
        return $this->hasMany(AssignmentSubmission::class)
            ->where('is_evaluated', '<', 1);
    }

    /**
     * @return HasMany
     */
    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Delete Event.
     */
    public function delete_and_sync()
    {
        DB::table('course_user')->where('course_id', $this->id)->delete();
        $this->sections()->delete();
        $this->contents()->delete(); //Delete lecture, assignments, quiz
//        $this->contents_attachments()->delete();
        $this->assignment_submissions()->delete();
        DB::table('completes')->where('course_id', $this->id)->delete();
        DB::table('completes')->whereCourseId('completed_course_id', $this->id)->delete();
        $this->delete();

        return $this;
    }

    /**
     * Sync anytime With Contents.
     */
    public function sync_everything()
    {
        $course = $this;
        $course_runtime = $course->lectures->sum('video_time');
        $total_lectures = $course->lectures->count();
        $total_assignments = $course->assignments->count();
        $total_quiz = $course->quizzes->count();

        $course->total_video_time = $course_runtime;
        $course->total_lectures = $total_lectures;
        $course->total_assignments = $total_assignments;
        $course->total_quiz = $total_quiz;
        $course->last_updated_at = now()->toDateTimeString();
        $course->save();
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('course', $this->slug);
    }

    /**
     * @return bool
     */
    public function getIAmInstructorAttribute()
    {
        if (! Auth::check()) {
            return false;
        }
        $user_id = Auth::user()->id;

        return $this->instructors->contains($user_id);
    }

    /**
     * @param $value
     * @return int
     */
    public function getLevelAttribute($value)
    {
        return (int) $value;
    }

    /**
     * @param $value
     * @return bool
     */
    public function getPaidAttribute($value)
    {
        return $this->price_plan === 'paid';
    }

    /**
     * @param $value
     * @return bool
     */
    public function getFreeAttribute($value)
    {
        return $this->price_plan === 'free';
    }

    /**
     * @param null $user
     * @return int
     */
    public function completed_percent($user = null)
    {
        /*
         * If not passed user id, get user id from auth
         * if auth user is not available, return percent 0;
         */

        if (! $user) {
            $user = Auth::user();
        }
        if (! $user instanceof User) {
            $user = User::find($user);
        }

        $completed_course = (array) $user->get_option('completed_courses');

        return (int) Arr::get($completed_course, $this->id.'.percent');

        /*
        $total_contents = (int) Content::whereCourseId($this->id)->count();
        $total_completed = (int) Complete::whereUserId($user->id)->whereCourseId($this->id)->count();

        if ( ! $total_contents || ! $total_completed){
            return 0;
        }

        return (int) number_format(($total_completed * 100 ) / $total_contents);

        */
    }

    /**
     * @return null|array
     */
    public function getBenefitsArrAttribute()
    {
        if (! $this->benefits) {
            return null;
        }
        $newArr = [];
        if ($this->benefits) {
            $newArr = explode("\n", $this->benefits);
        }
        $Arr = array_filter(array_map('trim', $newArr));

        return $Arr;
    }

    /**
     * @return null|array
     */
    public function getRequirementsArrAttribute()
    {
        if (! $this->requirements) {
            return null;
        }
        $newArr = [];
        if ($this->requirements) {
            $newArr = explode("\n", $this->requirements);
        }
        $Arr = array_filter(array_map('trim', $newArr));

        return $Arr;
    }

    /**
     * @return null|string
     */
    public function getContinueUrlAttribute()
    {
        if (! Auth::check()) {
            return null;
        }

        $completed_ids = Complete::whereUserId(Auth::id())->whereCourseId($this->id)->pluck('content_id')->toArray();

        $content = Content::whereCourseId($this->id)->whereNotIn('id', $completed_ids)->orderBy('order_column', 'asc')->first();

        if (! $content) {
            $content = Content::whereCourseId($this->id)->orderBy('order_column', 'asc')->first();
        }
        if (! $content) {
            return null;
        }

        return route('single_'.$content->item_type, [$this->slug, $content->id]);
    }

    /**
     * @return null|int|string
     */
    public function getGetPriceAttribute()
    {
        if ($this->price_plan && $this->price_plan !== 'free' && $this->price > 0) {
            $current_price = $this->sale_price > 0 ? $this->sale_price : $this->price;

            return $current_price;
        }

        return 0;
    }

    /**
     * @param false $originalPriceOnRight
     * @param false $showOff
     * @return string
     */
    public function price_html($originalPriceOnRight = false, $showOff = false)
    {
        $priceLocation = ' current-price-left ';
        if ($originalPriceOnRight) {
            $priceLocation = ' current-price-right ';
        }

        $price_html = "<div class='price-html-wrap {$priceLocation}'>";
        if ($this->paid && $this->price > 0) {
            $current_price = $this->sale_price > 0 ? price_format($this->sale_price) : price_format($this->price);

            if (! $originalPriceOnRight) {
                $price_html .= " <span class='current-price'>{$current_price}</span>";
            }

            if ($this->sale_price > 0) {
                $old_price = price_format($this->price);
                $price_html .= " <span class='old-price'><s>{$old_price}</s></span>";

                if ($showOff) {
                    $discount = number_format(100 - ($this->sale_price * 100 / $this->price), 2);
                    $offText = $discount.'% '.__('theme.off');
                    $price_html .= " <span class='discount-text mr-2'>{$offText}</span>";
                }
            }

            if ($originalPriceOnRight) {
                $price_html .= " <span class='current-price'>{$current_price}</span>";
            }
        } else {
            $price_html .= '<span class="free-text mr-2">'.__('theme.free').'</span>';
        }
        $price_html .= '</div>';

        return $price_html;
    }

    /**
     * @param bool $badge
     * @return string
     */
    public function status_html($badge = true)
    {
        $status = $this->status;

        $class = $badge ? 'badge badge' : 'status-text text';

        $html = "<span class='{$class}-dark'> <i class='la la-pencil-square-o'></i> ".__('theme.draft').'</span>';

        switch ($status) {
            case 1:
                $html = "<span class='{$class}-success'> <i class='la la-check-circle'></i> ".__('theme.published').'</span>';
                break;
            case 2:
                $html = "<span class='{$class}-info'> <i class='la la-clock-o'></i> ".__('theme.pending').'</span>';
                break;
            case 3:
                $html = "<span class='{$class}-danger'> <i class='la la-ban'></i> ".__('theme.blocked').'</span>';

                break;
            case 4:
                $html = "<span class='{$class}-warning'> <i class='la la-exclamation-circle'></i> ".__('theme.unpublished').'</span>';
                break;
        }

        if ($this->is_popular) {
            $html .= "<span class='badge badge-primary mx-2' data-toggle='tooltip' title='Popular'> <i class='la la-bolt'></i></span>";
        }
        if ($this->is_featured) {
            $html .= "<span class='badge badge-info mx-2'  data-toggle='tooltip' title='Featured'> <i class='la la-bookmark'></i></span>";
        }

        return $html;
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
            return Arr::get($video_info, $key);
        }

        return $video_info;
    }

    /**
     * @return mixed
     */
    public function reviews()
    {
        return $this->hasMany(Review::class)->whereStatus(1)->with('user')->orderBy('id', 'desc');
    }

    /**
     * @param null $key
     * @return array|mixed
     */
    public function get_ratings($key = null)
    {
        $ratingCount = $this->rating_count;

        $five_percent = 0;
        if ($this->five_star_count > 0) {
            $five_percent = ($this->five_star_count * 100) / $ratingCount;
        }
        $four_percent = 0;
        if ($this->four_star_count > 0) {
            $four_percent = ($this->four_star_count * 100) / $ratingCount;
        }
        $three_percent = 0;
        if ($this->three_star_count > 0) {
            $three_percent = ($this->three_star_count * 100) / $ratingCount;
        }
        $two_percent = 0;
        if ($this->two_star_count > 0) {
            $two_percent = ($this->two_star_count * 100) / $ratingCount;
        }
        $one_percent = 0;
        if ($this->one_star_count > 0) {
            $one_percent = ($this->one_star_count * 100) / $ratingCount;
        }

        $ratings = [
            'rating_count'  => $ratingCount,
            'rating_avg'    => $this->rating_value,
            'stats'    => [
                5 => [
                    'count'    => $this->five_star_count,
                    'percent'  => number_format($five_percent),
                ],
                4 => ['count'    => $this->four_star_count,
                    'percent'  => number_format($four_percent),
                ],
                3 => ['count'   => $this->three_star_count,
                    'percent' => number_format($three_percent),
                ],
                2 => ['count'     => $this->two_star_count,
                    'percent'   => number_format($two_percent),
                ],
                1 => ['one_count'     => $this->one_star_count,
                    'percent'   => number_format($one_percent),
                ],
            ],
        ];

        if ($key) {
            return Arr::get($ratings, $key);
        }

        return $ratings;
    }

    /**
     * @return array[]
     */
    public function getDripItemsAttribute()
    {
        $dripItems = [
            'sections' => [],
            'contents' => [],
        ];

        if (! Auth::check()) {
            return $dripItems;
        }

        $dripSectionIds = [];
        $dripContentIds = [];
        $dripSections = $this->sections()->where('unlock_date', '!=', null)->orWhere('unlock_days', '>', 0)->get();
        $dripContents = $this->contents()->where('unlock_date', '!=', null)->orWhere('unlock_days', '>', 0)->get();

        $time = Carbon::now()->timestamp;
        $user = Auth::user();
        $isEnrol = $user->isEnrolled($this->id);

        foreach ($dripSections as $dripSection) {
            if ($dripSection->unlock_date && strtotime($dripSection->unlock_date) > $time) {
                $dripSectionIds[] = $dripSection->id;
            } elseif ($dripSection->unlock_days && $dripSection->unlock_days > 0) {
                $unlock_date = Carbon::parse($isEnrol->enrolled_at)->addDays($dripSection->unlock_days);
                $now = Carbon::now();

                if ($unlock_date->gt($now)) {
                    $dripSectionIds[] = $dripSection->id;
                }
            }
        }

        foreach ($dripContents as $dripContent) {
            if ($dripContent->unlock_date && strtotime($dripContent->unlock_date) > $time) {
                $dripContentIds[] = $dripContent->id;
            } elseif ($dripContent->unlock_days && $dripContent->unlock_days > 0) {
                $unlock_date = Carbon::parse($isEnrol->enrolled_at)->addDays($dripContent->unlock_days);
                $now = Carbon::now();

                if ($unlock_date->gt($now)) {
                    $dripContentIds[] = $dripContent->id;
                }
            }
        }

        $dripItems['sections'] = array_unique($dripSectionIds);
        $dripItems['contents'] = array_unique($dripContentIds);

        return $dripItems;
    }
}
