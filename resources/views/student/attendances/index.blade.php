@extends('layouts.student.main')

@section('title', 'Student | Attendance')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Attendance</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('student.batch.enrollment', $batch) }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @if (count($attendances) > 0)
                        <table class="table table-bordered text-center" id="table-bhai">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Date</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attendance->attendance->date->format('d-M-Y') }}</td>
                                        <td>
                                            @if ($attendance->status == 1)
                                                <span class="badge bg-success">Present</span>
                                            @else
                                                <span class="badge bg-danger">Absent</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger text-center" role="alert">No record Found</div>
                    @endif
                </div>
            </div>
        </div>
    </main>

@endsection
