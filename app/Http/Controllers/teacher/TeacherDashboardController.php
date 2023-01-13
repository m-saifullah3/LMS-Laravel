<?php

namespace App\Http\Controllers\teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index( ) {
 
        return view('teacher.dashbaord.index' );
    }


    public function show(Teacher $teacher)
    { 
        $id =  Auth::user()->id;
        $data = [
            'teacher' => User::find($id)
        ];
        return view('teacher.profile.show', $data);
    }
}
