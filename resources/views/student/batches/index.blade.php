@extends('layouts.student.main')

@section('title', 'student | Batches')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Batches</h3>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @if (count($enrollments) > 0)
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Reg. No.</th>
                                    <th>Course</th>
                                    <th>Shift</th>
                                    <th>Starting Date</th>
                                    <th>Ending Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enrollments as $enrollment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $enrollment->reg_no }}</td>
                                        <td>{{ $enrollment->batch->course->name }}</td>
                                        <td>{{ $enrollment->batch->class_shift->shift }}</td>
                                        <td>{{ $enrollment->batch->starting_date->format('d-M-Y') }}</td>
                                        <td>{{ $enrollment->batch->ending_date->format('d-M-Y') }}</td>
                                        <td>
                                            <a href="{{ route('student.batch.class', $enrollment->batch) }}"
                                                class="btn btn-primary btn-sm">Classes</a>
                                            <a href="{{ route('student.batch.attendance', $enrollment->batch) }}"
                                                class="btn btn-primary btn-sm">Attendance</a>
                                            <a href="{{ route('student.batch.remarks', $enrollment->batch) }}"
                                                class="btn btn-primary btn-sm">Remarks</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger" role="alert">
                            No record found!
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
