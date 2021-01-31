<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Review
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $course_id
 * @property int|null $review_id
 * @property string|null $review
 * @property int|null $rating
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course|null $course
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUserId($value)
 * @mixin \Eloquent
 */
class Review extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->with('photo_query');
    }

    public function save_and_sync($data = [])
    {
        if (is_array($data) && count($data)) {
            $this->update($data);
        } else {
            $this->save();
        }

        $course = $this->course;

        $ratingCount = $course->reviews->count();

        $ratingVal = '0.00';
        if ($ratingCount > 0) {
            $ratingVal = $course->reviews->sum('rating');
            $ratingVal = $ratingVal / $ratingCount;
        }
        $one_star_count = $course->reviews()->whereRating(1)->count();
        $two_star_count = $course->reviews()->whereRating(2)->count();
        $three_star_count = $course->reviews()->whereRating(3)->count();
        $four_star_count = $course->reviews()->whereRating(4)->count();
        $five_star_count = $course->reviews()->whereRating(5)->count();

        $course->rating_value = $ratingVal;
        $course->rating_count = $ratingCount;
        $course->five_star_count = $five_star_count;
        $course->four_star_count = $four_star_count;
        $course->three_star_count = $three_star_count;
        $course->two_star_count = $two_star_count;
        $course->one_star_count = $one_star_count;

        $course->save();

        return $this;
    }
}
