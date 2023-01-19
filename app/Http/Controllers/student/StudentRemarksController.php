<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Remarks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentRemarksController extends Controller
{
    public function index(Batch $batch)
    {
        $remarks = Remarks::where([
            ['batch_id', $batch->id],
            ['student_id', Auth::user()->student->id],
        ])->get();

        $data = [
            'remarks' =>$remarks,
            'batch' => $batch
        ];

        return view('student.remarks.index', $data);
    }
}
