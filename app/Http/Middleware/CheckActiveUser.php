<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


/**
 * Class CheckActiveUser
 * @package App\Http\Middleware
 */
class CheckActiveUser
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
        if (!$request->user()->is_active) {
            Auth::guard()->logout();
            return redirect()->route('login');
        }
        return $next($request);
    }
}
