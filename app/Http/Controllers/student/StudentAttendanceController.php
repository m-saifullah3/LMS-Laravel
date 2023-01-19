<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceDetails;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    public function index(Batch $batch)
    {
        $attendances = AttendanceDetails::where('student_id', Auth::user()->student->id)->whereHas(
            'attendance',
            fn ($query) => $query->where([
                'batch_id' => $batch->id,
            ])
        )->get();

        $data = [
            'attendances' => $attendances,
            'batch' => $batch
        ];

        return view('student.attendances.index', $data);
    }
}
