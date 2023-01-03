<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\ClassShift;
use App\Models\Course;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::with('course', 'class_shift')->get();
        return view('admin.batches.index', ['batches' => $batches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'shifts' => ClassShift::all(),  
            'courses' => Course::all(),  
            'teachers' => Teacher::all(),  
        ];
        return view('admin.batches.create', $data);
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
            'course' => ['required'],
            'shift' => ['required'],
            'teacher' => ['required'],
            'starting_date' => ['required']
        ]);

        $course = Course::find($request->course);

        $course_duration = explode(' ', $course->duration);
        $course_duration = $course_duration[0];

        $start_date = Carbon::createFromFormat('Y-m-d', $request->starting_date);
        $end_date = $start_date->addDays(($course_duration * 7) - 3);

        $data = [
            'course_id' => $request->course,
            'class_shift_id' => $request->shift,
            'starting_date' => $request->starting_date,
            'teacher_id' => $request->teacher,
            'ending_date' => $end_date,
            'seats' => 20,
        ];

        $is_batch_created = Batch::create($data);
        if ($is_batch_created) {
            return back()->with('success', 'Batch has been successfully created');
        } else {
            return back()->with('error', 'Batch has failed to create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch)
    {
        $data = [
            'shifts' => ClassShift::all(),  
            'courses' => Course::all(),
            'teachers' =>Teacher::all(),
            'batch' => $batch
        ];
        return view('admin.batches.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch)
    {
        $request->validate([
            'course' => ['required'],
            'shift' => ['required'],
            'starting_date' => ['required'],
            'ending_date' => ['required'],
        ]);

        if ($request->status) {
            $status = 1;
        } else {
            $status = 0;
        }

        $data = [
            'course_id' => $request->course,
            'class_shift_id' => $request->shift,
            'starting_date' => $request->starting_date,
            'ending_date' => $request->ending_date,
            'seats' => $request->seats,
            'status' => $status,
        ];

        $is_batch_updated = Batch::find($batch->id)->update($data);
        if ($is_batch_updated) {
            return back()->with('success', 'Batch has been successfully updated');
        } else {
            return back()->with('error', 'Batch has failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch)
    {
        //
    }
}
