<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::with('user', 'course')->get();
        return view('admin.teachers.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shifts = [
            'Morning',
            'Evening',
        ];

        $data = [
            'shifts' => $shifts,
            'courses' => Course::all(),
        ];
        return view('admin.teachers.create', $data);
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
            'picture' => ['mimes:png,jpg,jpeg'],
            'course' => ['required'],
            'shift' => ['required'],
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

        $file = $request['picture'];

        if ($file) {
            $file_name = 'aci-' . time() . '-' . $file->getClientOriginalName();
        } else {
            $file_name = 'default.png';
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone,
            'cnic' => $request->cnic,
            'password' => Hash::make('12345'),
            'profile_picture' => $file_name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'user_type' => 'Teacher',
        ];

        $is_user_created = User::create($data);

        if ($is_user_created) {

            if ($file) {
                $file->move(public_path('teacher_uploads'), $file_name);
            }

            $data = [
                'user_id' => $is_user_created->id,
                'course_id' => $request->course,
                'shift' => $request->shift,
            ];

            $is_teacher_created = Teacher::create($data);

            if ($is_teacher_created) {
                return back()->with('success', 'Teacher has been successfully created');
            } else {
                return back()->with('error', 'Teacher has failed to create');
            }
        } else {
            return back()->with('error', 'User has failed to create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        $shifts = [
            'Morning',
            'Evening',
        ];
        $data = [
            'shifts' => $shifts,
            'courses' => Course::all(),
            'teacher' => $teacher,
        ];
        return view('admin.teachers.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $shifts = [
            'Morning',
            'Evening',
        ];

        $data = [
            'shifts' => $shifts,
            'courses' => Course::all(),
            'teacher' => $teacher,
        ];
        // dd($courses);
        return view('admin.teachers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email,' . $teacher->user_id . ',id'], 
            'gender' => ['required'],
            'course' => ['required'],
            'shift' => ['required'],
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

        $file = $request['picture'];

        $file_name = '';
        $old_file_name = '';

        if ($file) {
            $file_name = 'aci-' . time() . '-' . $file->getClientOriginalName();
            $old_file_name = $teacher->user->profile_picture;
        } else {
            $file_name = $teacher->user->profile_picture;
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone,
            'cnic' => $request->cnic,
            'password' => Hash::make('12345'),
            'profile_picture' => $file_name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'user_type' => 'Teacher',
        ];

        $is_user_updated = User::find($teacher->user_id)->update($data);
        if ($is_user_updated) {
            $data = [
                'user_id' => $teacher->user_id,
                'course_id' => $request->course,
                'shift' => $request->shift
            ];

            $is_teacher_updated = Teacher::find($teacher->id)->update($data);

            if ($is_teacher_updated) {
                if ($file) {
                    File::delete(public_path('teacher_uploads/' . $old_file_name));
                    $is_file_uploaded = $file->move(public_path('teacher_uploads'), $file_name);
                    if ($is_file_uploaded) {
                        return back()->with('success', 'Teacher has been successfully updated');
                    } else {
                        return back()->with('error', 'Teacher has failed to update');
                    }
                } else {
                    return back()->with('success', 'Teacher has been successfully updated');
                }
            } else {
                return back()->with('error', 'Teacher has failed to update');
            }
        } else {
            return back()->with('error', 'User has failed to update');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
