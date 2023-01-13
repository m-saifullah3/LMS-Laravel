<?php

namespace App\Http\Controllers\teacher;

use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Enrollment;
use App\Models\Teacher;
use App\Http\Controllers\Controller;
use App\Models\Remarks;
use Illuminate\Http\Request;

class DynamicController extends Controller
{
    public function fetch_teachers()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $teachers = Teacher::with('user')->where('course_id', $data['courseId'])->get();
        if (count($teachers) > 0) {
            $output = '<option value="" selected hidden disabled>Select the teacher</option>';
            foreach ($teachers as $teacher) {
                $output .= '<option value="' . $teacher->id . '">' . $teacher->user->name . '</option>';
            }
        } else {
            $output = '<option value="" selected hidden disabled>No teacher found</option>';
        }

        return json_encode($output);
    }

    public function fetch_batches()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $batches = Batch::with('course', 'class_shift')->where([
            ['course_id', $data['courseId']],
            ['status', 0],
        ])->get();
        if (count($batches) > 0) {
            $output = '<option value="" selected hidden disabled>Select the batch</option>';
            foreach ($batches as $batch) {
                $output .= '<option value="' . $batch->id . '">' . $batch->course->name . ' (' . $batch->class_shift->shift . ')' . '</option>';
            }
        } else {
            $output = '<option value="" selected hidden disabled>No batch found</option>';
        }

        return json_encode($output);
    }

    public function fetch_attendance()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $attendance = Attendance::with('attendance_details')->where([
            ['batch_id', $data['batch_id']],
            ['date', $data['date']],
        ])->first();

        if ($attendance) {
            $output = '';
            foreach ($attendance->attendance_details as $item) {
                $enrollment = Enrollment::with('student')->where([
                    ['batch_id', $data['batch_id']],
                    ['student_id', $item->student_id],
                ])->first();
                $status = "";
                if ($item->status == 1) {
                    $status = '<span class="badge bg-success">Present</span>';
                }else{
                    $status = '<span class="badge bg-danger">Absent</span>';
                }
                $output .= '<tr><td>' . $enrollment->reg_no .'</td><td>' . $enrollment->student->user->name . '</td><td>' . $status . '</td></tr>';
            }
        } else {
            $output = 'NoAttendance';
        }
        return json_encode($output);
    }


    public function fetch_remarks()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $remarks = Remarks::where([
            ['batch_id', $data['batch_id']],
            ['week', $data['week']],
        ])->get();

        if (count($remarks) > 0) {
            $output = '';
            foreach ($remarks as $item) {
                $enrollment = Enrollment::with('student')->where([
                    ['batch_id', $data['batch_id']],
                    ['student_id', $item->student_id],
                ])->first();
                $output .= '<tr><td>' . $enrollment->reg_no .'</td><td>' . $enrollment->student->user->name . '</td><td>' . $item->remarks . '</td></tr>';
            }
        } else {
            $output = 'NoRemarks';
        }
        return json_encode($output);
    }
}


 
                                                 
                                             
                                           