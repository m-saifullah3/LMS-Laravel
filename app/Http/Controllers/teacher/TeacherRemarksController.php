<?php

namespace App\Http\Controllers\teacher;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Remarks;

class TeacherRemarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Batch $batch)
    {
        $course = Course::find($batch->course_id);

        $course_duration = explode(' ', $course->duration);
        $course_duration = $course_duration[0];

        $data = [
            'batch' => $batch,
            'duration' => $course_duration,
        ];

        return view('teacher.remarks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Batch $batch)
    {
        $batch = Batch::with('enrollments')->whereId($batch->id)->first();

        $course = Course::find($batch->course_id);
        $course_duration = explode(' ', $course->duration);
        $course_duration = $course_duration[0];

        $data = [
            'batch' => $batch,
            'duration' => $course_duration,
        ];
        return view('teacher.remarks.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Batch $batch, Request $request)
    {

        $request->validate([
            'week' => [
                'required',
                Rule::unique('remarks')->where(fn ($query) => $query->where([
                    ['batch_id', $batch->id],
                    ['week', $request->week],
                ]))
            ]
        ]);

        $students = $request->except('_token', 'week');

        $keys = array_keys($students);
        $values = [];
        foreach($keys as $key) {
            $values[] = array('required');
        }

        $thrilled_array = array_combine($keys, $values);

        $request->validate($thrilled_array);

        $count = 0;
        foreach ($students as $key => $value) {
            $key = explode('_', $key);
            $data = [
                'student_id' => $key[1],
                'batch_id' => $batch->id,
                'week' => $request->week,
                'remarks' => $value,
            ];
            if (Remarks::create($data)) {
                $count++;
            }
        }

        if ($count == count($students)) {
            return back()->with('success', 'Remarks has been successfully added!');
        } else {
            return back()->with('error', 'Remarks details has failed to add!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function students_remarks_index(Batch $batch)
    // {

    //     $course = Course::find($batch->course_id);

    //     $course_duration = explode(' ', $course->duration);
    //     $course_duration = $course_duration[0];

    //     $data = [
    //         'batch' => $batch,
    //         'duration' => $course_duration,
    //     ];

    //     return view('teacher.remarks.index', $data);
    // }

    // public function students_remarks_create(Batch $batch)
    // {
    //     $batch = Batch::with('enrollments')->whereId($batch->id)->first();

    //     $course = Course::find($batch->course_id);
    //     $course_duration = explode(' ', $course->duration);
    //     $course_duration = $course_duration[0];

    //     $data = [
    //         'batch' => $batch,
    //         'duration' => $course_duration,
    //     ];
    //     return view('teacher.remarks.create', $data);
    // }

    // public function students_remarks_store(Request $request, Batch $batch)
    // {

    //     $request->validate([
    //         'week' => ['required']
    //     ]);

    //     dd($request->all());
    // }
}
