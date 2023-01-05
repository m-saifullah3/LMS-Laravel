<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ClassShiftController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DynamicController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
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

Route::controller(LoginController::class)->middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/', 'view')->name('home');
    Route::get('/login', 'view')->name('login');
    Route::post('/login', 'login');
});

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(Authenticate::class)->group(function() {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::controller(CourseController::class)->group(function () {
        Route::get('courses', 'index')->name('courses');
        Route::get('add/course', 'create')->name('course.create');
        Route::post('add/course', 'store');
        Route::get('edit/{course}/course', 'edit')->name('course.edit');
        Route::post('edit/{course}/course', 'update');
    });

    Route::controller(ClassShiftController::class)->group(function () {
        Route::get('shifts', 'index')->name('shifts');
        Route::get('add/shift', 'create')->name('shift.create');
        Route::post('add/shift', 'store');
        Route::get('edit/{shift}/shift', 'edit')->name('shift.edit');
        Route::post('edit/{shift}/shift', 'update');
    });

    Route::controller(BatchController::class)->group(function () {
        Route::get('batches', 'index')->name('batches');
        Route::get('add/batch', 'create')->name('batch.create');
        Route::post('add/batch', 'store');
        Route::get('edit/{batch}/batch', 'edit')->name('batch.edit');
        Route::post('edit/{batch}/batch', 'update');
    });

    Route::controller(TeacherController::class)->group(function () {
        Route::get('teachers', 'index')->name('teachers');
        Route::get('add/teacher', 'create')->name('teacher.create');
        Route::post('add/teacher', 'store');
        Route::get('teacher/{teacher}/profile', 'show')->name('teacher.profile');
        Route::get('edit/{teacher}/teacher', 'edit')->name('teacher.edit');
        Route::post('edit/{teacher}/teacher', 'update');
    });

    Route::controller(StudentController::class)->group(function () {
        Route::get('students', 'index')->name('students');
        Route::get('add/student', 'create')->name('student.create');
        Route::post('add/student', 'store');
        Route::get('student/{student}/profile', 'show')->name('student.profile');
        Route::get('edit/{student}/student', 'edit')->name('student.edit');
        Route::post('edit/{student}/student', 'update');
    });

    Route::controller(EnrollmentController::class)->group(function () {
        Route::get('add/{student}/enrollment', 'create')->name('enrollment.create');
        Route::post('add/{student}/enrollment', 'store');
        Route::get('edit/{enrollment}/enrollment', 'edit')->name('enrollment.edit');
        Route::post('edit/{enrollment}/enrollment', 'update');
        Route::get('destroy/{enrollment}/enrollment', 'destroy')->name('enrollment.destroy');
    });

    Route::controller(DynamicController::class)->group(function () {
        Route::post('fetch/teachers', 'fetch_teachers')->name('fetch.teachers');
        Route::post('fetch/batches', 'fetch_batches')->name('fetch.batches');
    });

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

