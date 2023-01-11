<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\AttendanceDetails;
use Illuminate\Support\Facades\Auth;

class TeacherPanelController extends Controller
{
    public function batches_index()
    {
        $teacher = Auth::user()->teacher;
        $data = [
            'batches' => Batch::with('course', 'class_shift')->where('teacher_id', $teacher->id)->get(),
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

    public function students_attendance_index(Batch $batch) {
        $data = [
            'batch' => $batch
        ];
        return view('teacher.attendances.index', $data);
    }

    public function students_attendance_create(Batch $batch)
    {
        $batch = Batch::with('enrollments')->whereId($batch->id)->first();

        $data = [
            'batch' => $batch
        ];
        return view('teacher.attendances.create', $data);
    }

    public function students_attendance_store(Request $request, Batch $batch)
    {

        // $attendance = Attendance::where([
        //     ['batch_id', $batch->id],
        //     ['date', $request->date],
        // ])->get();

        $request->validate([
            'date' => ['required', 
            Rule::unique('attendances')->where( fn($query) => $query->where([
                ['batch_id', $batch->id],
                ['date', $request->date],
            ]))],
        ], [
            'date.unique' => 'Attendance for this date is already taken'
        ]);

        $data = [
            'date' => $request->date,
            'batch_id' => $batch->id,
        ];

        $is_attendance_created = Attendance::create($data);

        if ($is_attendance_created) {

            $students = $request->except('_token', 'date');
            $count = 0;
            foreach ($students as $key => $value) {
                $data = [
                    'student_id' => $key,
                    'attendance_id' => $is_attendance_created->id,
                    'status' => $value,
                ];
                if (AttendanceDetails::create($data)) {
                    $count++;
                }
            }

            if ($count == count($students)) {
                return back()->with('success', 'Attendance has been successfully added!');
            } else {
                return back()->with('error', 'Attendance details has failed to add!');
            }

        } else {
            return back()->with('error', 'Attendance has failed to add!');
        }



        // echo $request->student_1;
        // echo $request->student_2;
        // echo $request->student_3;
        // echo $request->student_4;
        // echo $request->student_5;
        // echo $request->student_6;
        // echo $request->student_7;
        // echo $request->student_8;

        // $batch = Batch::with('enrollments')->whereId($batch->id)->first();
        //     $enrollments = $batch->enrollments;

        // foreach ($enrollments as $value) {

        //     echo $request->input('student_' . $value->student_id); 

        // }
        // dd($request->all());
    }
}
