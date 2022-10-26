<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);

        if (!$request->get('name') && !$request->get('email')) {
            return route('konsultasi.index');
        }
    }
}
