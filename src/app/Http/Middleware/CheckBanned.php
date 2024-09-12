<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        if (Auth::check()) {
            if (Auth::user()->getRoleNames()->contains('banned')) {
                Auth::logout();
  
                $request->session()->invalidate();
                $request->session()->regenerateToken();
  
                return response()->json([
                    'banned' => true,
                ], 403);
            } else {
                return $next($request);
            }
        }
  
        return response()->json([
            'login' => false,
        ], 401);
    }
}
