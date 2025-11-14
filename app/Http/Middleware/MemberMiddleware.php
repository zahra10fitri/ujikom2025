<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'member') {
            return redirect()->route('login')->with('error', 'Harus login sebagai member!');
        }

        return $next($request);
    }
}
