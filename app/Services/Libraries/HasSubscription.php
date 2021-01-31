<?php

namespace App\Services\Libraries;

use App\Models\Subscription;

trait HasSubscription
{
    /**
     * Get all of the subscriptions for the user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class)->orderBy('created_at', 'desc');
    }
}
