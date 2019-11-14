<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Administrator
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
        if (auth()->user()->role != User::ADMINISTRATOR) {
            return redirect()->to('/app/dashboard')->with('error', 'Resource Access Denied - RAD!');
        }
        return $next($request);
    }
}
