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
        // Debug output to check user authentication status
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }
        
        // Check if user is admin, with more detailed error message
        if (Auth::user()->user_type !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'You do not have admin access. Your role is: ' . Auth::user()->user_type);
        }

        return $next($request);
    }
}
