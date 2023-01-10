<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherPanelController extends Controller
{
    public function batches_index()
    {
        $teacher = Auth::user()->teacher;
        $data = [
            'batches' =>Batch::with('course', 'class_shift')->where('teacher_id', $teacher->id)->get(),
        ];
        return view('teacher.batches.index', $data);
    }

    public function batch_students_index(Batch $batch)
    {
        $batch = Batch::with('enrollments')->whereId($batch->id)->first();
        $enrollments = $batch->enrollments;
        $data = [
            'enrollments' => $enrollments
        ];
        return view('teacher.students.index', $data);
    }

    public function students_attendance_create(Batch $batch)
    {
        $batch = Batch::with('enrollments')->whereId($batch->id)->first();

        $data = [
            'batch' => $batch
        ];
        return view('teacher.attendances.index', $data);
    }

    public function students_attendance_store(Request $request,Batch $batch)
    {
        $batch = Batch::with('enrollments')->whereId($batch->id)->first();
        $enrollments = $batch->enrollments;
        
        // echo $request->student_1;
        // echo $request->student_2;
        // echo $request->student_3;
        // echo $request->student_4;
        // echo $request->student_5;
        // echo $request->student_6;
        // echo $request->student_7;
        // echo $request->student_8;

        foreach ($enrollments as $value) {

            echo $request->input('student_' . $value->student_id); 

        }
        // dd($request->all());
    }
}
