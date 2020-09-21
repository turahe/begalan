<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\Course
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $parent_category_id
 * @property int|null $second_category_id
 * @property int|null $category_id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $short_description
 * @property string|null $description
 * @property string|null $benefits
 * @property string|null $requirements
 * @property string|null $price_plan
 * @property string|null $price
 * @property string|null $sale_price
 * @property int|null $level
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
 * @property string|null $rating_value
 * @property int|null $rating_count
 * @property int|null $five_star_count
 * @property int|null $four_star_count
 * @property int|null $three_star_count
 * @property int|null $two_star_count
 * @property int|null $one_star_count
 * @property int|null $is_featured
 * @property string|null $featured_at
 * @property int|null $is_popular
 * @property string|null $popular_added_at
 * @property \Illuminate\Support\Carbon|null $last_updated_at
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AssignmentSubmission[] $assignment_submissions
 * @property-read int|null $assignment_submissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AssignmentSubmission[] $assignment_submissions_waiting
 * @property-read int|null $assignment_submissions_waiting_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Content[] $assignments
 * @property-read int|null $assignments_count
 * @property-read \App\User|null $author
 * @property-read \App\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Content[] $contents
 * @property-read int|null $contents_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attachment[] $contents_attachments
 * @property-read int|null $contents_attachments_count
 * @property-read mixed $benefits_arr
 * @property-read mixed $continue_url
 * @property-read mixed $drip_items
 * @property-read mixed $free
 * @property-read mixed $get_price
 * @property-read mixed $i_am_instructor
 * @property-read mixed $paid
 * @property-read mixed $requirements_arr
 * @property-read mixed $thumbnail_url
 * @property-read mixed $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $instructors
 * @property-read int|null $instructors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Content[] $lectures
 * @property-read int|null $lectures_count
 * @property-read \App\Media|null $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attempt[] $quiz_attempts
 * @property-read int|null $quiz_attempts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Content[] $quizzes
 * @property-read int|null $quizzes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Section[] $sections
 * @property-read int|null $sections_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $students
 * @property-read int|null $students_count
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course publish()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereFeaturedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereFiveStarCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereFourStarCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereIsPopular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereIsPresale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereLastUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereLaunchAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereOneStarCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereParentCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePopularAddedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePricePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereRatingCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereRatingValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereRequireEnroll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereRequireLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSecondCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereThreeStarCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereThumbnailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTotalAssignments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTotalLectures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTotalQuiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTotalVideoTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTwoStarCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereVideoSrc($value)
 * @mixin \Eloquent
 */
class Course extends Model
{
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
     * @param $query
     * @return mixed
     */
    public function scopePublish($query){
        return $query->where('status', 1)->with('media', 'author', 'category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function instructors()
    {
        return $this->belongsToMany(User::class)->withPivot('added_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students(){
        return $this->belongsToMany(User::class, 'enrolls')->where('status', 'success')->withPivot('enrolled_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections(){
        return $this->hasMany(Section::class)->orderBy('sort_order', 'asc');
    }

    /**
     * @return mixed
     */
    public function lectures(){
        return $this->hasMany(Content::class)->whereItemType('lecture');
    }

    /**
     * @return mixed
     */
    public function assignments(){
        return $this->hasMany(Content::class)->whereItemType('assignment');
    }

    /**
     * @return mixed
     */
    public function quizzes(){
        return $this->hasMany(Content::class)->whereItemType('quiz');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quiz_attempts(){
        return $this->hasMany(Attempt::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignment_submissions(){
        return $this->hasMany(AssignmentSubmission::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignment_submissions_waiting(){
        return $this->hasMany(AssignmentSubmission::class)->where('is_evaluated', '<', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents(){
        return $this->hasMany(Content::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents_attachments(){
        return $this->hasMany(Attachment::class, 'belongs_course_id', 'id');
    }
    /**
     * Delete Event
     */
    public function delete_and_sync(){
        DB::table('course_user')->where('course_id', $this->id)->delete();
        $this->sections()->delete();
        $this->contents()->delete(); //Delete lecture, assignments, quiz
        $this->contents_attachments()->delete();
        $this->assignment_submissions()->delete();
        DB::table('completes')->where('course_id', $this->id)->delete();
        DB::table('completes')->whereCourseId('completed_course_id', $this->id)->delete();
        $this->delete();
        return $this;
    }

    /**
     * Sync anytime With Contents
     */
    public function sync_everything(){
        $now = Carbon::now()->toDateTimeString();

        $course = $this;
        $course_runtime = $course->lectures->sum('video_time');
        $total_lectures = $course->lectures->count();
        $total_assignments = $course->assignments->count();
        $total_quiz = $course->quizzes->count();

        $course->total_video_time = $course_runtime;
        $course->total_lectures = $total_lectures;
        $course->total_assignments = $total_assignments;
        $course->total_quiz = $total_quiz;
        $course->last_updated_at = $now;
        $course->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media(){
        return $this->belongsTo(Media::class, 'thumbnail_id');
    }

    /**
     * @return string
     */
    public function getUrlAttribute(){
        return route('course', $this->slug);
    }

    /**
     * @return mixed
     */
    public function getThumbnailUrlAttribute(){
        return media_image_uri($this->media)->image_sm;
    }

    /**
     * @return bool
     */
    public function getIAmInstructorAttribute(){
        if ( ! Auth::check()){
            return false;
        }
        $user_id = Auth::user()->id;
        return $this->instructors->contains($user_id);
    }

    /**
     * @param $value
     * @return int
     */
    public function getLevelAttribute($value){
        return (int) $value;
    }

    /**
     * @param $value
     * @return bool
     */
    public function getPaidAttribute($value){
        return $this->price_plan === 'paid';
    }

    /**
     * @param $value
     * @return bool
     */
    public function getFreeAttribute($value){
        return $this->price_plan === 'free';
    }

    /**
     * @param null $user
     * @return int
     */
    public function completed_percent($user = null){
        /**
         * If not passed user id, get user id from auth
         * if auth user is not available, return percent 0;
         */

        if ( ! $user){
            $user = Auth::user();
        }
        if ( ! $user instanceof User) {
            $user = \App\User::find($user);
        }

        $completed_course = (array) $user->get_option('completed_courses');
        return (int) array_get($completed_course, $this->id.".percent");

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
     * @return array|null
     */
    public function getBenefitsArrAttribute(){
        if ( ! $this->benefits){
            return null;
        }
        $newArr = array();
        if ($this->benefits){
            $newArr = explode("\n", $this->benefits);
        }
        $Arr = array_filter(array_map('trim', $newArr));
        return $Arr;
    }

    /**
     * @return array|null
     */
    public function getRequirementsArrAttribute(){
        if ( ! $this->requirements){
            return null;
        }
        $newArr = array();
        if ($this->requirements){
            $newArr = explode("\n", $this->requirements);
        }
        $Arr = array_filter(array_map('trim', $newArr));
        return $Arr;
    }

    /**
     * @return string|null
     */
    public function getContinueUrlAttribute(){
        if ( ! Auth::check()){
            return null;
        }

        $user_id = Auth::user()->id;
        $completed_ids = Complete::whereUserId($user_id)->whereCourseId($this->id)->pluck('content_id')->toArray();

        $content = Content::whereCourseId($this->id)->whereNotIn('id', $completed_ids)->orderBy('sort_order', 'asc')->first();

        if ( ! $content){
            $content = Content::whereCourseId($this->id)->orderBy('sort_order', 'asc')->first();
        }
        if ( ! $content){
            return null;
        }
        return route('single_'.$content->item_type, [$this->slug, $content->id ] );
    }

    /**
     * @return int|string|null
     */
    public function getGetPriceAttribute(){
        if ($this->price_plan && $this->price_plan !== 'free' && $this->price > 0){
            $current_price = $this->sale_price > 0 ?  $this->sale_price : $this->price;

            return $current_price;
        }
        return 0;
    }

    /**
     * @param false $originalPriceOnRight
     * @param false $showOff
     * @return string
     */
    public function price_html($originalPriceOnRight = false, $showOff = false){

        $priceLocation = ' current-price-left ';
        if ($originalPriceOnRight){
            $priceLocation = ' current-price-right ';
        }

        $price_html = "<div class='price-html-wrap {$priceLocation}'>";
        if ( $this->paid && $this->price > 0){

            $current_price = $this->sale_price > 0 ?  price_format($this->sale_price) : price_format($this->price);

            if ( ! $originalPriceOnRight){
                $price_html .= " <span class='current-price'>{$current_price}</span>";
            }

            if ($this->sale_price > 0){
                $old_price = price_format($this->price);
                $price_html .= " <span class='old-price'><s>{$old_price}</s></span>";

                if ($showOff) {
                    $discount = number_format( 100 - ($this->sale_price * 100   / $this->price)   , 2);
                    $offText = $discount . '% ' . __t('off');
                    $price_html .= " <span class='discount-text mr-2'>{$offText}</span>";
                }
            }

            if ($originalPriceOnRight){
                $price_html .= " <span class='current-price'>{$current_price}</span>";
            }


        }else{
            $price_html .= '<span class="free-text mr-2">'.__t('free').'</span>';
        }
        $price_html .= '</div>';

        return $price_html;
    }

    /**
     * @param bool $badge
     * @return string
     */
    public function status_html($badge = true){
        $status = $this->status;

        $class = $badge ? 'badge badge' : 'status-text text';

        $html = "<span class='{$class}-dark'> <i class='la la-pencil-square-o'></i> ".__t('draft')."</span>";

        switch ($status){
            case 1:
                $html = "<span class='{$class}-success'> <i class='la la-check-circle'></i> ".__t('published')."</span>";
                break;
            case 2:
                $html = "<span class='{$class}-info'> <i class='la la-clock-o'></i> ".__t('pending')."</span>";
                break;
            case 3:
                $html = "<span class='{$class}-danger'> <i class='la la-ban'></i> ".__t('blocked')."</span>";

                break;
            case 4:
                $html = "<span class='{$class}-warning'> <i class='la la-exclamation-circle'></i> ".__t('unpublished')."</span>";
                break;
        }

        if ($this->is_popular){
            $html .= "<span class='badge badge-primary mx-2' data-toggle='tooltip' title='Popular'> <i class='la la-bolt'></i></span>";
        }
        if ($this->is_featured){
            $html .= "<span class='badge badge-info mx-2'  data-toggle='tooltip' title='Featured'> <i class='la la-bookmark'></i></span>";
        }

        return $html;
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
     * @return mixed
     */
    public function reviews(){
        return $this->hasMany(Review::class)->whereStatus(1)->with('user')->orderBy('id', 'desc');
    }

    /**
     * @param null $key
     * @return array|mixed
     */
    public function get_ratings($key = null){

        $ratingCount = $this->rating_count;

        $five_percent = 0;
        if ($this->five_star_count > 0){
            $five_percent = ($this->five_star_count * 100) / $ratingCount;
        }
        $four_percent = 0;
        if ($this->four_star_count > 0){
            $four_percent = ($this->four_star_count * 100) / $ratingCount;
        }
        $three_percent = 0;
        if ($this->three_star_count > 0){
            $three_percent = ($this->three_star_count * 100) / $ratingCount;
        }
        $two_percent = 0;
        if ($this->two_star_count > 0){
            $two_percent = ($this->two_star_count * 100) / $ratingCount;
        }
        $one_percent = 0;
        if ($this->one_star_count > 0){
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
                ]
            ]
        ];

        if ($key){
            return array_get($ratings, $key);
        }

        return $ratings;
    }

    /**
     * @return array[]
     */
    public function getDripItemsAttribute(){
        $dripItems = [
            'sections' => [],
            'contents' => [],
        ];

        if ( ! Auth::check()){
            return $dripItems;
        }

        $dripSectionIds = [];
        $dripContentIds = [];
        $dripSections = $this->sections()->where('unlock_date', '!=', null)->orWhere('unlock_days', '>', 0)->get();
        $dripContents = $this->contents()->where('unlock_date', '!=', null)->orWhere('unlock_days', '>', 0)->get();


        $time = Carbon::now()->timestamp;
        $user = Auth::user();
        $isEnrol = $user->isEnrolled($this->id);

        foreach ($dripSections as $dripSection){
            if ($dripSection->unlock_date && strtotime($dripSection->unlock_date) > $time ){
                $dripSectionIds[] = $dripSection->id;
            }elseif ($dripSection->unlock_days && $dripSection->unlock_days > 0 ){
                $unlock_date = Carbon::parse($isEnrol->enrolled_at)->addDays($dripSection->unlock_days);
                $now = Carbon::now();

                if ($unlock_date->gt($now)){
                    $dripSectionIds[] = $dripSection->id;
                }
            }
        }

        foreach ($dripContents as $dripContent){
            if ($dripContent->unlock_date && strtotime($dripContent->unlock_date) > $time ){
                $dripContentIds[] = $dripContent->id;
            }elseif ($dripContent->unlock_days && $dripContent->unlock_days > 0 ){
                $unlock_date = Carbon::parse($isEnrol->enrolled_at)->addDays($dripContent->unlock_days);
                $now = Carbon::now();

                if ($unlock_date->gt($now)){
                    $dripContentIds[] = $dripContent->id;
                }
            }
        }

        $dripItems['sections'] = array_unique($dripSectionIds);
        $dripItems['contents'] = array_unique($dripContentIds);

        return $dripItems;
    }

}
