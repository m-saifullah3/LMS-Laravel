<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\ClassShift;
use App\Models\Course;
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
            'starting_date' => ['required'],
            'ending_date' => ['required'],
        ]);

        $data = [
            'course_id' => $request->course,
            'class_shift_id' => $request->shift,
            'starting_date' => $request->starting_date,
            'ending_date' => $request->ending_date,
            'seats' => 20,
        ];

        $is_batch_created = Batch::create($data);
        if ($is_batch_created) {
            return back()->with('success', 'Batch has been successfully created');
        } else {
            return back()->with('success', 'Batch has failed to create');
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
        //
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
