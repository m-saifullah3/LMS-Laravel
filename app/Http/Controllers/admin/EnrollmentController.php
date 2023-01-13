<?php

namespace App\Http\Controllers\admin;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Student $student)
    {
        $data = [
            'student' => $student,
            'courses' => Course::all(),
            'batches' => Batch::all(),
        ];

        return view('admin.enrollments.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Student $student)
    {
        $request->validate([
            'course' => ['required'],
            'batch' => ['required'],
        ]);

        // Store Calling

        $is_already_enrolled = $student->is_already_enrolled($request->course, $student->id, $request->batch);

        // $enrollments = Enrollment::with('batch')->where('student_id', '=', $student->id)->get();

        // $is_already_enrolled = false;

        // $batch = Batch::with('course')->find($request->batch);

        // foreach($enrollments as $enrollment) {
        //     if ($enrollment->batch->id == $request->batch || $enrollment->batch->course_id == $request->course || $batch->course_id == $enrollment->batch->course_id) {
        //         $is_already_enrolled = true;
        //     }
        // }

        if ($is_already_enrolled) {
            return back()->with('error', 'Student is already enrolled in this course');
        }
        // else {
        //     return back()->with('success', 'Student is ready to get enrolled'); 
        // }

        $batch = Batch::where([
            ['seats', '>', 0],
            ['id', $request->batch],
        ])->first();
        
        if ($batch) {
            $course = Course::find($request->course);

            $words = explode(" ", $course->name);
            $acronym = "";

            foreach ($words as $w) {
                $acronym .= $w[0];
            }

            $reg = "ACI-" . $acronym . "-" . $student->id;

            $data = [
                'student_id' => $student->id,
                'course_id' => $request->course,
                'batch_id' => $request->batch,
                'reg_no' => $reg
            ];

            $is_enrollment_added = Enrollment::create($data);

            if ($is_enrollment_added) {
              $seats = $batch->seats;
                $data = [
                    'seats' => --$seats
                ];
                Batch::find($request->batch)->update($data);
                return back()->with('success', 'Enrollment has been succesfully added');
            } else {
                return back()->with('error', 'Enrollment has failed to add');
            }
        } else {
            return back()->with('error', 'No seats are available for this batch');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit(Enrollment $enrollment)
    {
        $data = [
            'enrollment' => $enrollment,
            'courses' => Course::all(),
            'batches' => Batch::all(),
        ];
        return view('admin.enrollments.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'course' => ['required'],
            'batch' => ['required'],
        ]);

        // Update Calling
        $is_already_enrolled = $enrollment->student->is_already_enrolled($request->course, $enrollment->student_id, $request->batch, $enrollment->id);

        if ($is_already_enrolled) {
            return back()->with('error', 'Student is already enrolled in this course');
        }
        // else {
        //     return back()->with('success', 'Student is ready to get enrolled'); 
        // }

        $data = [
            'course_id' => $request->course,
            'batch_id' => $request->batch,
        ];

        $is_enrollment_updated = Enrollment::find($enrollment->id)->update($data);

        if ($is_enrollment_updated) {
            return back()->with('success', 'Enrollment has been succesfully updated');
        } else {
            return back()->with('error', 'Enrollment has failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        $is_enrollment_deleted = Enrollment::find($enrollment->id)->delete();

        if ($is_enrollment_deleted) {
            return back()->with('success', 'Enrollment has been succesfully deleted');
        } else {
            return back()->with('error', 'Enrollment has failed to delete');
        }
    }
}
