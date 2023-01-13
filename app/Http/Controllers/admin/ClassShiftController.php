<?php

namespace App\Http\Controllers\admin;

use App\Models\ClassShift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = ClassShift::all();
        return view('admin.classShifts.index', ['shifts' => $shifts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.classShifts.create');
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
            'start' => ['required'],
            'end' => ['required'],
            'shift' => ['required', 'unique:class_shifts,shift'],
        ]);

        $data = [
            'start' => $request->start,
            'end' => $request->end,
            'shift' => $request->shift
        ];

        $is_shift_created = ClassShift::create($data);

        if ($is_shift_created) {
            return back()->with('success', 'Class Shift has been successfully created');
        } else {
            return back()->with('error', 'Class Shift has failed to create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassShift  $classShift
     * @return \Illuminate\Http\Response
     */
    public function show(ClassShift $classShift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassShift  $classShift
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassShift $shift)

    {
        return view('admin.classShifts.edit', ['shift' => $shift]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassShift  $classShift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassShift $shift)
    {
        $request->validate([
            'start' => ['required'],
            'end' => ['required'],
            'shift' => ['required', 'unique:class_shifts,shift,' . $shift->id . ',id'],
        ]);

        $data = [
            'start' => $request->start,
            'end' => $request->end,
            'shift' => $request->shift
        ];

        $is_shift_updated = ClassShift::find($shift->id)->update($data);

        if ($is_shift_updated) {
            return back()->with('success', 'Class Shift has been successfully updated');
        } else {
            return back()->with('error', 'Class Shift has failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassShift  $classShift
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassShift $classShift)
    {
        //
    }
}
