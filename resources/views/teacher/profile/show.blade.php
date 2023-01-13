@extends('layouts.teacher.main')

@section('title', 'Admin | Teacher Profile')

@section('contents')

    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Teacher Profile</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-primary">Back</a>
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
                                    <img src="{{ asset('teacher_uploads/' . $teacher->profile_picture) }}" alt="avatar" class="rounded-circle img-fluid"
                                        style="width: 150px; height: 150px">
                                    <h5 class="my-3">{{ $teacher->name }}</h5>
                                    @if ($teacher->status == 1)
                                        <span class="text-white badge bg-success mb-3">Active</span>
                                    @else
                                        <p class="text-white badge bg-danger  mb-3">Inactive</p>
                                    @endif   
                                      <p class="text-muted mb-">{{ $teacher->qualification }}</p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <a href="{{ route('admin.teacher.edit', $teacher) }}" class="btn btn-primary">Edit
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
                                            <p class="text-muted mb-0">{{ $teacher->name }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $teacher->email }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Date of birth</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $teacher->dob }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Gender</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $teacher->gender }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $teacher->phone_no }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">CNIC</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $teacher->cnic }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $teacher->address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     
                </div>
            </div>
    </main>









@endsection
