<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->hasCookie('laravel_session') && Auth::viaRemember()) {
            $rememberToken = Auth::getRememberToken();
            $rememberDuration = Auth::getRememberDuration();
        
            $rememberExpires = now()->addMinutes($rememberDuration);
        
            if ($rememberExpires->isPast()) {
                Auth::logout();
            } else {
                $request->merge(['remember' => true]);
            }
        }

        if (! $request->expectsJson()) {
            return route('login');
        }

    }
}
