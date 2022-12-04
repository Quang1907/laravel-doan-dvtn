<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckInfomation
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
        if ( !( auth()->user() ) || !auth()->user()->phonenumber || !auth()->user()->birthday || !auth()->user()->password || !auth()->user()->address ) {
            return redirect( "account/confirm" );
        }

        return $next($request);
    }
}
