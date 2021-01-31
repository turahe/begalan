<?php

namespace App\Services\Helpers;

use App\Models\User;
use Illuminate\Support\Str;

class Token
{
    /**
     * Return a unique personal access token.
     */
    public static function generate(): string
    {
        do {
            $api_token = Str::random(60);
        } while (User::where('api_token', $api_token)->exists());

        return $api_token;
    }
}
