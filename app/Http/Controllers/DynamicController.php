<?php

namespace App\Http\Controllers;

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
            $output = '<option value="" selected hidden disabled>No teacher f   ound</option>';
        }
        
        return json_encode($output);
    }
}
