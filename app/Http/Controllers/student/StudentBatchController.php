<?php

namespace App\Http\Controllers\student;

use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentBatchController extends Controller
{
    public function index(Student $student) {
        $data = [
            'enrollments' => Enrollment::where('student_id', $student->id)->get(),
        ];

        return view('student.batches.index',$data);
    }
}
