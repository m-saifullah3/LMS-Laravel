<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\CourseController;
// use App\Models\Role;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'view')->name('home');
    Route::get('/login', 'view')->name('login');
    Route::post('/login', 'login');
});

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::controller(CourseController::class)->group(function () {
    Route::get('/admin/courses', 'index')->name('admin.courses');
    Route::get('/admin/add/course', 'create')->name('admin.course.create');
    Route::post('/admin/add/course', 'store');
    Route::get('/admin/edit/{course}/course', 'edit')->name('admin.course.edit');
    Route::post('/admin/edit/{course}/course', 'update');
});

Route::get('/teacher/dashboard', function () {
    return "Teacher Dashboard";
})->name('teacher.dashboard');

Route::get('/student/dashboard', function () {
    return "Student Dashboard";
})->name('student.dashboard');

// Route::get('/create', function() {
//     return Hash::make('12345');
// });

