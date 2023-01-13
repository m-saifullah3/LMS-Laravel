<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\ClassShift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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

        // dd($request->all());
        $request->validate([
            'course' => ['required'],
            'shift' => ['required'],
            'teacher' => ['required'],
            'starting_date' => ['required'],
            // 'starting_date.already' => [
            //     'required',
            //     Rule::unique('batches')->where(
            //         fn ($query) => $query
            //             ->where('course_id', $request->course)
            //             ->where('teacher_id', $request->teacher)
            //             ->where('class_shift_id', $request->shift)
            //             ->where('starting_date', $request->starting_date)
            //     ),
            // ]
        ]);

        // $batch_1 = Batch::where('course_id', $request->course)
        //     ->where('teacher_id', $request->teacher)
        //     ->Where('class_shift_id', $request->shift)
        //     // ->orWhere('starting_date', $request->starting_date)
        //     ->get();

        // $batch_2 = Batch::where('course_id', $request->course)
        //     ->where('teacher_id', $request->teacher)
        //     ->where('starting_date', $request->starting_date)
        //     ->get();

        $is_already_batch_created = Batch::is_already_batch_created($request->course, $request->teacher, $request->shift, $request->starting_date);

        if ($is_already_batch_created) {
            return back()->with('error', 'Batch is already created with this input data');
        }

        // $batch_2 = Batch::where('course_id', $request->course)
        //     ->where('teacher_id', $request->teacher)
        //     ->where('starting_date', $request->starting_date)
        //     ->get();

        // dump($batch_1);
        // dump($batch_2);

        // Course
        // Teacher
        // Shift

        // (course AND teacher) AND shift 

        // Course
        // Teacher
        // Start Date

        // (course AND teacher) AND start date 

        // Select * from batches WHERE (course=course AND teacher=tecaher AND shift=shift) OR (course=course AND teacher=tecaher AND start=start)

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
            'status' => 0,
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
        $statuses = [
            'Open For Enrollment',
            'Closed For Enrollment',
            'Active For Classes',
        ];
        $data = [
            'shifts' => ClassShift::all(),
            'courses' => Course::all(),
            'teachers' => Teacher::all(),
            'statuses' => $statuses,
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
            'teacher' => ['required'],
            'shift' => ['required'],
            'starting_date' => ['required'],
            'ending_date' => ['required'],
            'seats' => ['required'],
        ]);

        $is_already_batch_created = Batch::is_already_batch_created($request->course, $request->teacher, $request->shift, $request->starting_date, $batch->id);

        if ($is_already_batch_created) {
            return back()->with('error', 'Batch is already created with this input data');
        }

        $data = [
            'course_id' => $request->course,
            'teacher_id' => $request->teacher,
            'class_shift_id' => $request->shift,
            'starting_date' => $request->starting_date,
            'ending_date' => $request->ending_date,
            'seats' => $request->seats,
            'status' => $request->status,
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
