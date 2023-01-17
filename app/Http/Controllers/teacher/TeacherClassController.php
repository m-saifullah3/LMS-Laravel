<?php

namespace App\Http\Controllers\teacher;

use App\Models\Batch;
use App\Models\Course;
use App\Models\TeacherClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Batch $batch)
    {
        $data = [
            'batch' => $batch,
        ];
        // dd($batch->classes);
        return view('teacher.classes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Batch $batch)
    {
        // $course = Course::find($batch->course_id);
        // $course_duration = explode(' ', $course->duration);
        // $course_duration = $course_duration[0];
        // $course_duration = $course_duration * 5;

        $data = [
            'batch' => $batch,
        ];
        return view('teacher.classes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Batch $batch)
    {

        $request->validate([
            'date' => ['required'],
            'topic' => ['required'],
            'file' => ['mimes:zip,rar'],

        ]);

        $file = $request['file'];

        if ($file) {
            $file_name = 'aci-' . time() . '-' . $file->getClientOriginalName();
        } else {
            $file_name = NULL;
        }

        $classes = count($batch->classes);

        $class_no = 1;

        if ($classes > 0) {
            $class_no = $classes + 1;
        }

        $data = [
            'batch_id' => $batch->id,
            'date' => $request->date,
            'class_no' => $class_no,
            'topic' => $request->topic,
            'description' => $request->desc,
            'tasks' => $request->tasks,
            'file' => $file_name,
        ];

        $is_class_created = TeacherClass::create($data);

        if ($is_class_created) {
            if ($file) {
                $is_file_created =  $file->move(public_path('class_material'), $file_name);

                if (!$is_file_created) {
                    return back()->with('error', 'File has failed to upload!');
                }
            }

            return back()->with('success', 'Class has been successfully created');
        } else {
            return back()->with('error', 'Class has failed to create');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherClass  $teacherClass
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherClass $teacherClass)
    {

        $data = [
            'class' => $teacherClass,
        ];
        return view('teacher.classes.show',  $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherClass  $teacherClass
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherClass $teacherClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherClass  $teacherClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherClass $teacherClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherClass  $teacherClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherClass $teacherClass)
    {
        //
    }
}
