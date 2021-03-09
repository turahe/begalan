<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->guest(route('login'))->with('error', trans('app.unauthorized_access'));
        }

        if (! Auth::user()->hasAnyRole('admin', 'instructor')) {
            return redirect(route('dashboard'))->with('error', __('access_restricted'));
        }

        return $next($request);
    }
}
