<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $provider_user_id
 * @property string|null $provider
 * @property string|null $reset_token
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Earning[] $earnings
 * @property-read int|null $earnings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Course[] $enrolls
 * @property-read int|null $enrolls_count
 * @property-read mixed $earning
 * @property-read string $get_photo
 * @property-read mixed $get_rating
 * @property-read bool $is_admin
 * @property-read bool $is_instructor
 * @property-read object|null $withdraw_method
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Discussion[] $instructor_discussions
 * @property-read int|null $instructor_discussions_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attempt[] $my_quiz_attempts
 * @property-read int|null $my_quiz_attempts_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $purchases
 * @property-read int|null $purchases_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Enroll[] $student_enrolls
 * @property-read int|null $student_enrolls_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Course[] $wishlist
 * @property-read int|null $wishlist_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Withdraw[] $withdraws
 * @property-read int|null $withdraws_count
 * @method static \Illuminate\Database\Eloquent\Builder|User active()
 * @method static \Illuminate\Database\Eloquent\Builder|User instructor()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProviderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereResetToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use Notifiable;
    use InteractsWithMedia;
    use HasFactory;
    use HasRoles;

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
        $enrolledCourse = array_unique($enrolledCourse);
        $this->update_option('enrolled_courses', $enrolledCourse);

        return $this;
    }

    /**
     * Earning Related.
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
