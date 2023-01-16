@extends('layouts.teacher.main')

@section('title', 'Teacher | Batches')

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
                    @if (count($batches) > 0)
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Course</th>
                                    <th>Shift</th>
                                    <th>Starting Date</th>
                                    <th>Ending Date</th>
                                    <th>Seats</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batches as $batch)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $batch->course->name }}</td>
                                        <td>{{ $batch->class_shift->shift }}</td>
                                        <td>{{ $batch->starting_date->format('d-M-Y') }}</td>
                                        <td>{{ $batch->ending_date->format('d-M-Y') }}</td>
                                        <td>{{ $batch->seats }}</td>
                                        <td>
                                            @if ($batch->status == 0)
                                                <div class="m-0 alert alert-primary p-1" role="alert">
                                                    Open for enrollment
                                                </div>
                                                {{-- <span class="badge bg-primary"></span> --}}
                                            @elseif ($batch->status == 1)
                                                <div class="m-0 alert alert-danger  p-1" role="alert">
                                                    Closed for enrollment
                                                </div>
                                                {{-- <span class="badge bg-danger">Closed for enrollment</span> --}}
                                            @elseif ($batch->status == 2)
                                                <div class="m-0 alert alert-info p-1" role="alert">
                                                    Active for class
                                                </div>
                                                {{-- <span class="badge bg-danger">Active for class</span> --}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('teacher.batch.students', $batch) }}"
                                                class="btn btn-primary btn-sm">Students</a>

                                            <a href="{{ route('teacher.student.attendances.index', $batch) }}"
                                                class="btn btn-primary btn-sm">Attendance</a>

                                            <a href="{{ route('teacher.student.remarks.index', $batch) }}"
                                                class="btn btn-primary btn-sm">Remarks</a>

                                                <a href="{{ route('teacher.student.classes.index', $batch) }}"
                                                class="btn btn-primary btn-sm">Classes</a>
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
