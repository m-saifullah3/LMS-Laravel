<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'students' => Student::with('user', 'enrollments')->get()
        ];

        return view('admin.students.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'courses' => Course::all(),
            'batches' => Batch::with('class_shift')->get(),
        ];
        return view('admin.students.create', $data);
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
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'gender' => ['required'],
            'course' => ['required'],
            'batch' => ['required'],
            'qualification' => ['required'],
            'occupation' => ['required'],
        ]);

        if (!empty($request->phone)) {
            $request->validate([
                'phone' => ['unique:users,phone_no']
            ]);
        }

        if (!empty($request->cnic)) {
            $request->validate([
                'cnic' => ['unique:users,cnic']
            ]);
        }

        $seats = Batch::where([
            ['seats', '>', 0],
            ['id', $request->batch],
        ])->get();

        if (count($seats) == 0) {
            return back()->with('error', 'No seats available');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345'),
            'phone_no' => $request->phone,
            'cnic' => $request->cnic,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'profile_picture' => 'default.png',
            'user_type' => 'Student',
        ];

        $is_user_created = User::create($data);

        if ($is_user_created) {

            if ($request->basic_computer_knowledge) {
                $basic_computer_knowledge = 1;
            } else {
                $basic_computer_knowledge = 0;
            }

            $data = [
                'user_id' => $is_user_created->id,
                'qualification' => $request->qualification,
                'basic_computer_knowledge' => $basic_computer_knowledge,
                'occupation' => $request->occupation,
            ];

            $is_student_created = Student::create($data);

            if ($is_student_created) {
                $course = Course::find($request->course);

                $words = explode(" ", $course->name);
                $acronym = "";

                foreach ($words as $w) {
                    $acronym .= $w[0];
                }

                $reg = "ACI-" . $acronym . "-" . $is_student_created->id;
                $data = [
                    'student_id' => $is_student_created->id,
                    'batch_id' => $request->batch,
                    'reg_no' => $reg
                ];

                $is_entrollment_created = Enrollment::create($data);

                if ($is_entrollment_created) {

                    $batch = Batch::find($request->batch);
                    $seats = $batch->seats;
                    $seats--;

                    $data = [
                        'seats' => $seats
                    ];

                    $is_batch_updated = Batch::find($request->batch)->update($data);

                    if ($is_batch_updated) {
                        return back()->with('success', 'Student has been successfully created');
                    } else {
                        return back()->with('error', 'Batch has failed to update');
                    }
                } else {
                    return back()->with('error', 'Enrollement has failed to create');
                }
            } else {
                return back()->with('error', 'Student has failed to create');
            }
        } else {
            return back()->with('error', 'User has failed to create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $data = [
            'student' => $student,
        ];
        return view('admin.students.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $data = [
            'courses' => Course::all(),
            'student' => $student,
            'batches' => Batch::with('class_shift')->get(),
        ];
        return view('admin.students.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email,' . $student->user_id . ',id'],
            'gender' => ['required'],
            'qualification' => ['required'],
            'occupation' => ['required'],
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone,
            'cnic' => $request->cnic,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
        ];
        $is_user_upated = User::find($student->user_id)->update($data);

        if ($is_user_upated) {

            if ($request->basic_computer_knowledge) {
                $basic_computer_knowledge = 1;
            } else {
                $basic_computer_knowledge = 0;
            }
            $data = [
                'qualification' => $request->qualification,
                'basic_computer_knowledge' => $basic_computer_knowledge,
                'occupation' => $request->occupation,

            ];
            $is_student_updated  = Student::find($student->id)->update($data);
            if ($is_student_updated) {
                return back()->with('success', 'Student has been successfully updated');
            } else {
                return back()->with('error', 'Student has failed to update');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
