@extends('layouts.admin.main')

@section('title', 'Admin | Student Profile')

@section('contents')

    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Student Profile</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.students') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('partials.alerts')
                    <h3>Personal Details</h3>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="{{ asset('student_uploads/' . $student->user->profile_picture) }}" alt="avatar" class="rounded-circle img-fluid"
                                        style="width: 150px; height: 150px">
                                    <h5 class="my-3">{{ $student->user->name }}</h5>
                                    @if ($student->status == 1)
                                        <span class="text-white badge bg-success mb-3">Active</span>
                                    @else
                                        <p class="text-white badge bg-danger  mb-3">Inactive</p>
                                    @endif
                                    <p class="text-muted mb-">{{ $student->qualification }}</p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <a href="{{ route('admin.student.edit', $student) }}" class="btn btn-primary">Edit
                                            Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $student->user->name }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $student->user->email }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Date of birth</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $student->user->dob }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Qualification</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $student->qualification }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Occupation</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $student->occupation }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Gender</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $student->user->gender }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $student->user->phone_no }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">CNIC</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $student->user->cnic }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $student->user->address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>Enrollment Details</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Sr. No</th>
                                                <th>Course</th>
                                                <th>Teacher</th>
                                                <th>Shift</th>
                                                <th>Reg. No.</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($student->enrollments as $enrollment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $enrollment->batch->course->name }}</td>
                                                    <td>{{ $enrollment->batch->teacher->user->name }}</td>
                                                    <td>{{ $enrollment->batch->class_shift->shift . ' (' . $enrollment->batch->class_shift->start->format('h:i A') . '-' . $enrollment->batch->class_shift->end->format('h:i A') . ')' }}
                                                    </td>
													<td>{{ $enrollment->reg_no }}</td>
													<td>
                                                        <a href="{{ route('admin.enrollment.edit', $enrollment) }}" class="btn btn-primary">Edit</a>
                                                        <a href="{{ route('admin.enrollment.destroy', $enrollment) }}" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>









@endsection
