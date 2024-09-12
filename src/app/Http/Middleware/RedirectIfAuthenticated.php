<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard == 'admin'){
                    return redirect(RouteServiceProvider::ADMIN_HOME);
                }
                return redirect(RouteServiceProvider::HOME);

                // //ユーザーのロールを取得しその中に[banned]というロールが含まれているかチェック
                // $is_banned = User::find(Auth::id())->getRoleNames()->contains('banned');

                // return response()->json([
                //     'login' => true,
                //     'is_banned' => $is_banned,
                // ], 200);
            }
        }

        return $next($request);
    }
}
