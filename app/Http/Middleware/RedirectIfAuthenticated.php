<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                $user = Auth::user();
                $user_type = strtolower($user->user_type);
                if ($user_type == 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user_type == 'teacher') {
                    return redirect()->route('teacher.dashboard');
                } elseif ($user_type == 'student') {
                    return redirect()->route('student.dashboard');
                }
                
                // return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
