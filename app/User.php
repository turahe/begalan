<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property null|string $email
 * @property null|\Illuminate\Support\Carbon $email_verified_at
 * @property string $password
 * @property null|string $gender
 * @property null|string $company_name
 * @property null|int $country_id
 * @property null|string $address
 * @property null|string $address_2
 * @property null|string $city
 * @property null|string $zip_code
 * @property null|string $postcode
 * @property null|string $website
 * @property null|string $phone
 * @property null|string $about_me
 * @property null|string $date_of_birth
 * @property null|int $photo
 * @property null|string $job_title
 * @property null|string $options
 * @property null|string $user_type
 * @property null|int $active_status
 * @property null|string $provider_user_id
 * @property null|string $provider
 * @property null|string $reset_token
 * @property null|string $remember_token
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property-read null|\App\Country $country
 * @property-read \App\Course[]|\Illuminate\Database\Eloquent\Collection $courses
 * @property-read null|int $courses_count
 * @property-read \App\Earning[]|\Illuminate\Database\Eloquent\Collection $earnings
 * @property-read null|int $earnings_count
 * @property-read \App\Course[]|\Illuminate\Database\Eloquent\Collection $enrolls
 * @property-read null|int $enrolls_count
 * @property-read mixed $earning
 * @property-read mixed $get_photo
 * @property-read mixed $get_rating
 * @property-read mixed $is_admin
 * @property-read mixed $is_instructor
 * @property-read mixed $withdraw_method
 * @property-read \App\Discussion[]|\Illuminate\Database\Eloquent\Collection $instructor_discussions
 * @property-read null|int $instructor_discussions_count
 * @property-read \App\Media[]|\Illuminate\Database\Eloquent\Collection $medias
 * @property-read null|int $medias_count
 * @property-read \App\Attempt[]|\Illuminate\Database\Eloquent\Collection $my_quiz_attempts
 * @property-read null|int $my_quiz_attempts_count
 * @property-read \Illuminate\Notifications\DatabaseNotification[]|\Illuminate\Notifications\DatabaseNotificationCollection $notifications
 * @property-read null|int $notifications_count
 * @property-read null|\App\Media $photo_query
 * @property-read \App\Payment[]|\Illuminate\Database\Eloquent\Collection $purchases
 * @property-read null|int $purchases_count
 * @property-read \App\Review[]|\Illuminate\Database\Eloquent\Collection $reviews
 * @property-read null|int $reviews_count
 * @property-read \App\Enroll[]|\Illuminate\Database\Eloquent\Collection $student_enrolls
 * @property-read null|int $student_enrolls_count
 * @property-read \App\Course[]|\Illuminate\Database\Eloquent\Collection $wishlist
 * @property-read null|int $wishlist_count
 * @property-read \App\Withdraw[]|\Illuminate\Database\Eloquent\Collection $withdraws
 * @property-read null|int $withdraws_count
 * @method static \Illuminate\Database\Eloquent\Builder|User active()
 * @method static \Illuminate\Database\Eloquent\Builder|User instructor()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAboutMe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActiveStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProviderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereResetToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereZipCode($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active_status', 1)->with('photo_query');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeInstructor($query)
    {
        return $query->where('user_type', 'instructor');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class)->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function get_reviews()
    {
        return $this->belongsToMany(Review::class, 'course_user', 'user_id', 'course_id', 'id', 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function instructor_discussions()
    {
        return $this->belongsToMany(Discussion::class, 'course_user', 'user_id', 'course_id', 'id', 'course_id')->with('user', 'user.photo_query')->where('discussion_id', 0);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlist()
    {
        return $this->belongsToMany(Course::class, 'wishlists');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function earnings()
    {
        return $this->hasMany(Earning::class, 'instructor_id')->where('payment_status', 'success');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function withdraws()
    {
        return $this->hasMany(Withdraw::class)->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases()
    {
        return $this->hasMany(Payment::class)->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function my_quiz_attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    /**
     * @return mixed
     */
    public function getGetRatingAttribute()
    {
        $sql = "select count(reviews.id) as rating_count,
avg(reviews.rating) as rating_avg
from reviews
inner join course_user on reviews.course_id = course_user.course_id
where course_user.user_id = {$this->id} and reviews.status = 1";

        $rating = DB::selectOne(DB::raw($sql));
        $rating->rating_avg = number_format($rating->rating_avg, 2);
        return $rating;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    /**
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    /**
     * @return bool
     */
    public function isInstructor()
    {
        return $this->user_type === 'instructor' || $this->isAdmin();
    }

    /**
     * @return bool
     */
    public function getIsInstructorAttribute()
    {
        return $this->isInstructor();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo_query()
    {
        return $this->belongsTo(Media::class, 'photo');
    }

    /**
     * @return string
     */
    public function getGetPhotoAttribute()
    {
        if ($this->photo) {
            $url = media_image_uri($this->photo_query)->thumbnail;
            return "<img src='{$url}' class='profile-photo' alt='{$this->name}' /> ";
        }

        $arr = explode(' ', trim($this->name));

        if (count($arr) > 1) {
            $first_char = substr($arr[0], 0, 1) ;
            $second_char = substr($arr[1], 0, 1) ;
        } else {
            $first_char = substr($arr[0], 0, 1) ;
            $second_char = substr($arr[0], 1, 1) ;
        }

        $textPhoto = strtoupper($first_char.$second_char);

        $bg_color = '#'.substr(md5($textPhoto), 0, 6);
        $textPhoto = "<span class='profile-text-photo' style='background-color: {$bg_color}; color: #fff8e5'>{$textPhoto}</span>";

        return $textPhoto;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function enrolls()
    {
        return $this->belongsToMany(Course::class, 'enrolls')->wherePivot('status', '=', 'success');
    }

    /**
     * @param int $course_id
     * @return false
     */
    public function isEnrolled($course_id = 0)
    {
        if ($course_id === 0) {
            return false;
        }

        $isEnrolled = DB::table('enrolls')->whereUserId($this->id)->whereCourseId($course_id)->whereStatus('success')->orderBy('enrolled_at', 'desc')->first();

        return $isEnrolled;
    }


    /**
     * @param $course_id
     * @return mixed
     */
    public function isInstructorInCourse($course_id)
    {
        return $this->courses()->whereCourseId($course_id)->first();
    }

    /**
     * @param null $course_id
     * @return bool
     *
     * Complete Course
     */
    public function complete_course($course_id = null)
    {
        if (! $course_id) {
            return false;
        }

        $is_completed = Complete::whereCompletedCourseId($course_id)->whereUserId($this->id)->first();

        if ($is_completed) {
            return $is_completed;
        }
        $data = [
            'user_id'               => $this->id,
            'completed_course_id'   => $course_id,
            'completed_at'          => Carbon::now()->toDateTimeString(),
        ];
        return Complete::create($data);
    }

    /**
     * @param $course_id
     * @return Complete|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function is_completed_course($course_id)
    {
        $is_completed = Complete::whereCompletedCourseId($course_id)->whereUserId($this->id)->first();
        return $is_completed;
    }

    /**
     * @param null $key
     * @param null $default
     * @return mixed|null
     */
    public function get_option($key = null, $default = null)
    {
        if ($this->options) {
            $options = (array) json_decode($this->options, true);
            $value = get_from_array($key, $options);

            if ($value) {
                return $value;
            }
        }
        return $default;
    }

    /**
     * @param null $key
     * @param string $value
     */
    public function update_option($key = null, $value = '')
    {
        if ($key) {
            $options = (array) json_decode($this->options, true);
            $options[$key] = $value;
            $this->update(['options' => $options]);
        }
    }

    /**
     * @return mixed
     */
    public function student_enrolls()
    {
        return $this->belongsToMany(Enroll::class, 'course_user', 'user_id', 'course_id', 'id', 'course_id')->whereStatus('success');
    }

    /**
     * @return $this
     */
    public function enroll_sync()
    {
        $enrolledCourse = (array) $this->enrolls()->pluck('course_id')->all();
        $enrolledCourse =  array_unique($enrolledCourse);
        $this->update_option('enrolled_courses', $enrolledCourse);

        return $this;
    }

    /**
     * Earning Related
     */

    public function getEarningAttribute()
    {
        $sales_amount = $this->earnings->sum('amount');

        $earnings = $this->earnings->sum('instructor_amount');
        $commission = $this->earnings->sum('admin_amount');

        $withdraws_sum = $this->withdraws->where('status', '!=', 'rejected')->sum('amount');
        $withdraws_total = $this->withdraws->where('status', 'approved')->sum('amount');

        $balance = $earnings - $withdraws_sum;

        $data = [
            'sales_amount'  => $sales_amount,
            'commission'  => $commission,
            'earnings'  => $earnings,
            'balance'  => $balance,
            'withdrawals'  => $withdraws_total,
        ];

        return (object) $data;
    }


    /**
     * @return object|null
     */
    public function getWithdrawMethodAttribute()
    {
        $method = $this->get_option('withdraw_preference');
        $method_key = array_get($method, 'method');

        if (! array_get($method, 'method')) {
            return null;
        }

        $saved_method = active_withdraw_methods($method_key);
        $saved_method['method_key'] = $method_key;
        $form_fields = array_get($saved_method, 'form_fields');

        if (is_array($form_fields) && count($form_fields)) {
            foreach ($form_fields as $form_key => $form_value) {
                $form_value['value'] = array_get($method, $method_key.'.'.$form_key);
                $form_fields[$form_key] = $form_value;
            }
        }

        $saved_method['form_fields'] = $form_fields;
        $saved_method['admin_form_fields'] = get_option("withdraw_methods.{$method_key}");

        return (object) $saved_method;
    }

    /**
     * @param $quiz_id
     * @return Attempt|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function get_attempt($quiz_id)
    {
        $attempt = Attempt::where('user_id', $this->id)->where('quiz_id', $quiz_id)->first();
        return $attempt;
    }
}
