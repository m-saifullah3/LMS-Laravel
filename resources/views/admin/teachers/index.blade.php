@extends('layouts.admin.main')

@section('title', 'Admin | Teachers')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Teachers</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.teacher.create') }}" class="btn btn-outline-primary">Add Teacher</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                        @if (count($teachers) > 0)
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Course</th>
                                        <th>Shift</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $teacher->user->name }}</td>
                                            <td>{{ $teacher->user->email }}</td>
                                            <td>{{ $teacher->course->name }}</td>
                                            <td>
                                                @if (strtolower($teacher->shift) == 'morning')
                                                    <span class="badge bg-success">MORNING</span>
                                                @elseif (strtolower($teacher->shift) == 'afternoon')
                                                    <span class="badge bg-warning">AFTER NOON</span>
                                                @else
                                                    <span class="badge bg-dark">EVENING</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.teacher.profile', $teacher) }}"
                                                    class="btn btn-primary">Profile</a>
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
