<?php

namespace App\Services;

use App\Models\Rate;
use Illuminate\Support\Facades\Auth;

trait Rateable
{
    /**
     * This model has many ratings.
     *
     * @param  mixed  $value
     * @return void
     */
    public function rate($value)
    {
        $rating = new Rate();
        $rating->rating = $value;
        $rating->customer_id = Auth::id();

        $this->ratings()->save($rating);
    }

    public function rateOnce($value)
    {
        $rating = Rate::query()
            ->where('model_type', '=', get_class($this))
            ->where('model_id', '=', $this->id)
            ->where('customer_id', '=', Auth::id())
            ->first();

        if ($rating) {
            $rating->rating = $value;
            $rating->save();
        } else {
            $this->rate($value);
        }
    }

    /**
     * @return mixed
     */
    public function ratings()
    {
        return $this->morphMany(Rate::class, 'model');
    }

    /**
     * @return mixed
     */
    public function averageRating()
    {
        return $this->ratings->avg('rating');
    }

    /**
     * @return mixed
     */
    public function sumRating()
    {
        return $this->ratings->sum('rating');
    }

    /**
     * @return mixed
     */
    public function rating($value)
    {
        return $this->ratings->where('rating', $value)->count();
    }

    /**
     * @return mixed
     */
    public function timesRated()
    {
        return $this->ratings->count();
    }

    /**
     * @return mixed
     */
    public function usersRated()
    {
        return $this->ratings->groupBy('customer_id')->pluck('customer_id')->count();
    }

    /**
     * @return mixed
     */
    public function userAverageRating()
    {
        return $this->ratings->where('customer_id', Auth::id())->avg('rating');
    }

    /**
     * @return mixed
     */
    public function userSumRating()
    {
        return $this->ratings->where('customer_id', Auth::id())->sum('rating');
    }

    /**
     * @param  int  $max
     * @return float|int
     */
    public function ratingPercent($max = 5)
    {
        $quantity = $this->ratings()->count();
        $total = $this->sumRating();

        return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    }

    // Getters

    /**
     * @return mixed
     */
    public function getAverageRatingAttribute()
    {
        return $this->averageRating();
    }

    /**
     * @return mixed
     */
    public function getSumRatingAttribute()
    {
        return $this->sumRating();
    }

    /**
     * @return mixed
     */
    public function getUserAverageRatingAttribute()
    {
        return $this->userAverageRating();
    }

    /**
     * @return mixed
     */
    public function getUserSumRatingAttribute()
    {
        return $this->userSumRating();
    }
}
