<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DynamicController extends Controller
{
    public function fetch_teachers() {
        $data = json_decode(file_get_contents('php://input'), true);
        $teachers = Teacher::with('user')->where('course_id', $data['courseId'])->get();
        if(count($teachers) > 0) {
            $output = '<option value="" selected hidden disabled>Select the teacher</option>';
            foreach($teachers as $teacher) {
                $output .= '<option value="' . $teacher->id . '">' . $teacher->user->name .'</option>';
            }
        } else {
            $output = '<option value="" selected hidden disabled>No teacher found</option>';
        }
        
        return json_encode($output);
    }

    public function fetch_batches() {
        $data = json_decode(file_get_contents('php://input'), true);
        $batches = Batch::with('course', 'class_shift')->where('course_id', $data['courseId'])->get();
        if(count($batches) > 0) {
            $output = '<option value="" selected hidden disabled>Select the batch</option>';
            foreach($batches as $batch) {
                $output .= '<option value="' . $batch->id . '">' . $batch->course->name . ' (' . $batch->class_shift->shift . ')' .'</option>';
            }
        } else {
            $output = '<option value="" selected hidden disabled>No batch found</option>';
        }
        
        return json_encode($output);
    }
}
