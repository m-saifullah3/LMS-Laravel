<?php

namespace App\Http\Controllers\admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:courses,name'],
            'duration' => ['required']
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration
        ];

        $is_course_created = Course::create($data);

        if ($is_course_created) {
            return back()->with('success', 'Course has been successfully created');
        } else {
            return back()->with('error', 'Course has failed to create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => ['required', 'unique:courses,name,' . $course->id . ',id'],
            'duration' => ['required']
        ]);

        if ($request->status) {
            $status = 1;
        } else {
            $status = 0;
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'status' => $status
        ];

        $is_course_upated = Course::find($course->id)->update($data);

        if ($is_course_upated) {
            return back()->with('success', 'Course has been successfully updated');
        } else {
            return back()->with('error', 'Course has failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
