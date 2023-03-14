<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return null|array|string
     */
    protected function redirectTo($request)
    {
        if ($request->expectsJson()) {
            exit(json_encode(['success' => 0, 'message' => 'unauthenticated']));
        }

        return route('login');
    }
}
