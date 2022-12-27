<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($request->except(['_token']))) {
            $user = Auth::user();
            if (strtolower($user->user_type) == "admin") {
                return redirect()->route('admin.dashboard');
            } elseif (strtolower($user->user_type) == "teacher") {
                return redirect()->route('teacher.dashboard');
            }  elseif (strtolower($user->user_type) == "student") {
                return redirect()->route('student.dashboard');
            } else {
                return redirect()->route('login')->with('error', 'Invalid Combination');
            }
        } else {
            return redirect()->route('login')->with('error', 'Invalid Combination');
        }
    }
}
