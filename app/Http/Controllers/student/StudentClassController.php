<?php

namespace App\Http\Controllers\student;


use App\Models\Batch;
use App\Models\TeacherClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentClassController extends Controller
{
    public function index(Batch $batch){

        // return dd($batch);
        $data = [
            'batch' => $batch
        ];
        return view('student.classes.index', $data);
    }

    public function show(TeacherClass $class){

        // return dd($batch);
        $data = [
            'class' => $class
        ];
        return view('student.classes.show', $data);
    }
}
