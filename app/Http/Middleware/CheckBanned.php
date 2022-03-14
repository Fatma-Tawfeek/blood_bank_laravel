<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth('client-web')->check() && (auth('client-web')->user()->status == 0)){

            auth('client-web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            flash()->error('حسابك موقوف , يرجى التواصل مع الادارة');

            return back();
    }
        return $next($request);
    }
}
