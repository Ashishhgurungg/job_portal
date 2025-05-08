<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
           // Option A: via Auth facade
           if (Auth::check() && Auth::user()->role === 2) {
            return $next($request);
        }

        // Option B: via the request object
        // if ($user = $request->user() && $user->role === 2) {
        //     return $next($request);
        // }

        abort(403, 'Unauthorized. Only for Admin');
    
    }
}
