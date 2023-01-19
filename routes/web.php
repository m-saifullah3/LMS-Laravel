<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\admin\BatchController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\admin\StudentController;

use App\Http\Controllers\admin\TeacherController;
use App\Http\Controllers\teacher\DynamicController;
use App\Http\Controllers\admin\ClassShiftController;
use App\Http\Controllers\admin\EnrollmentController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\student\StudentAttendanceController;
use App\Http\Controllers\student\StudentBatchController;
use App\Http\Controllers\student\StudentClassController;
use App\Http\Controllers\student\StudentDashboardController;
use App\Http\Controllers\student\StudentRemarksController;
use App\Http\Controllers\teacher\TeacherBatchController;
use App\Http\Controllers\teacher\TeacherRemarksController;
use App\Http\Controllers\teacher\TeacherStudentController;
use App\Http\Controllers\teacher\TeacherClassController;

use App\Http\Controllers\teacher\TeacherDashboardController;
use App\Http\Controllers\teacher\TeacherAttendenceController;

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

Route::prefix('admin')->name('admin.')->middleware(Authenticate::class)->group(function () {
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

Route::prefix('teacher')->name('teacher.')->middleware(Authenticate::class)->group(function () {

    // Route::get('dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');

    Route::controller(TeacherDashboardController::class)->group(function () { 
        Route::get('dashboard', 'index')->name('dashboard');
        Route::get('/profile', 'show')->name('profile');

        // Route::get('students/{batch}/attendance', 'create')->name('students.attendance.create');
        // Route::post('students/{batch}/attendance', 'store');
    });

    Route::get('batches',[TeacherBatchController::class,'index'] )->name('batches');
    
    Route::get('batch/{batch}/students',[TeacherStudentController::class,'index'] )->name('batch.students');

    Route::controller(TeacherAttendenceController::class)->group(function () { 
        Route::get('student/{batch}/attendances', 'index')->name('student.attendances.index');
        Route::get('students/{batch}/attendance', 'create')->name('students.attendance.create');
        Route::post('students/{batch}/attendance', 'store');
    });

    Route::controller(TeacherRemarksController::class)->group(function () {   
        Route::get('student/{batch}/remarks', 'index')->name('student.remarks.index');
        Route::get('students/{batch}/remarks', 'create')->name('students.remarks.create');
        Route::post('students/{batch}/remarks', 'store');
    });

    Route::controller(TeacherClassController::class)->group(function () {   
        Route::get('student/{batch}/classes', 'index')->name('student.classes.index');
        Route::get('students/{batch}/class', 'create')->name('students.class.create');
        Route::post('students/{batch}/class', 'store');
        Route::get('class/{teacherClass}/show', 'show')->name('students.class.show');

    });

    Route::controller(DynamicController::class)->group(function () {
        Route::post('fetch/attendance', 'fetch_attendance')->name('fetch.attendance');
        Route::post('fetch/remarks', 'fetch_remarks')->name('fetch.remarks');
    });
});



Route::prefix('student')->name('student.')->middleware(Authenticate::class)->group(function () {
    Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
  
    Route::controller(StudentBatchController::class)->group(function () {
        Route::get('batch/{student}/enrollment', 'index')->name('batch.enrollment');
    });

    Route::controller(StudentAttendanceController::class)->group(function () {
        Route::get('{batch}/attendance', 'index')->name('batch.attendance');
    });

    Route::controller(StudentRemarksController::class)->group(function () {
        Route::get('{batch}/remarks', 'index')->name('batch.remarks');
    });

    Route::controller(StudentClassController::class)->group(function () {
        Route::get('batch/{batch}/class', 'index')->name('batch.class');
        Route::get('class/{class}/show', 'show')->name('batch.class.show');
    });

});

 
