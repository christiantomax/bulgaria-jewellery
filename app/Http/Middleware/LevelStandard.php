<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelStandard
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
        if(Auth::user()->IDLevel != 1 && Auth::user()->IDLevel != 2 && Auth::user()->IDLevel != 3)
            return redirect('dashboard');
        return $next($request);
    }
}
