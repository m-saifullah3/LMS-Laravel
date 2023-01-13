<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceDetails;
use App\Models\Batch;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class TeacherAttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Batch $batch)
    {
        $data = [
            'batch' => $batch
        ];
        return view('teacher.attendances.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Batch $batch)
    {
        $batch = Batch::with('enrollments')->whereId($batch->id)->first();

        $data = [
            'batch' => $batch
        ];
        return view('teacher.attendances.create', $data);
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
            'date' => [
                'required',
                Rule::unique('attendances')->where(fn ($query) => $query->where([
                    ['batch_id', $batch->id],
                    ['date', $request->date],
                ]))
            ],
        ], [
            'date.unique' => 'Attendance for this date is already taken'
        ]);

        $data = [
            'date' => $request->date,
            'batch_id' => $batch->id,
        ];

        $is_attendance_created = Attendance::create($data);

        if ($is_attendance_created) {

            $students = $request->except('_token', 'date');
            $count = 0;
            foreach ($students as $key => $value) {
                $data = [
                    'student_id' => $key,
                    'attendance_id' => $is_attendance_created->id,
                    'status' => $value,
                ];
                if (AttendanceDetails::create($data)) {
                    $count++;
                }
            }

            if ($count == count($students)) {
                return back()->with('success', 'Attendance has been successfully added!');
            } else {
                return back()->with('error', 'Attendance details has failed to add!');
            }
        } else {
            return back()->with('error', 'Attendance has failed to add!');
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

 
 
}



