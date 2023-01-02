@extends('layouts.admin.main')

@section('title', 'Admin | Teacher Profile')

@section('contents')

<main>
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="">Teacher Profile </h3>
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{ route('admin.teachers') }}" class="btn btn-outline-primary">Back</a>
                    </div>
                </div>

            </div>
            <div class="card-body">

                @include('partials.alerts')
                <section style="background-color: #eee;">
                    <div class="container py-5">
                      <div class="row">
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="card mb-4">
                            <div class="card-body text-center">
                              <img src="{{ asset('teacher_uploads/' . $teacher->user->profile_picture) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 150px">
                              <h5 class="my-3">{{ $teacher->user->name }}</h5>
                              @if ($teacher->status == 1 )
                              <span class="text-white badge bg-success mb-3">Active</span>
                              @else
                              <p class="text-white badge bg-danger  mb-3">Inactive</p>
                              @endif
                              <p class="text-muted ">{{ $teacher->qualification }}</p>
                              <div class="d-flex justify-content-center mb-2">
                                <a href="{{ route('admin.teacher.edit', $teacher) }}" class="btn btn-primary">Edit Profile</a>
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
                                  <p class="text-muted mb-0">{{ $teacher->user->name }}</p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-3">
                                  <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                  <p class="text-muted mb-0">{{ $teacher->user->email }}</p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-3">
                                  <p class="mb-0">Date of birth</p>
                                </div>
                                <div class="col-sm-9">
                                  <p class="text-muted mb-0">{{ $teacher->user->dob }}</p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-3">
                                  <p class="mb-0">Course</p>
                                </div>
                                <div class="col-sm-9">
                                  <p class="text-muted mb-0">{{ $teacher->course->name }}</p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-3">
                                  <p class="mb-0">Gender</p>
                                </div>
                                <div class="col-sm-9">
                                  <p class="text-muted mb-0">{{ $teacher->user->gender }}</p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-3">
                                  <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                  <p class="text-muted mb-0">{{ $teacher->user->phone_no }}</p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-3">
                                  <p class="mb-0">CNIC</p>
                                </div>
                                <div class="col-sm-9">
                                  <p class="text-muted mb-0">{{ $teacher->user->cnic }}</p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-3">
                                  <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                  <p class="text-muted mb-0">{{ $teacher->user->address }}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>






                {{-- <div class="text-center row w-25">
                    <img src="{{ asset('uploads/' . $teacher->user->profile_picture) }}" alt="image" width="150" class="text-center rounded-circle">
                </div>
                <hr>
                <div class="row">
                  <div class="col" style="text-align: justify;">
                    <div class="d-flex " style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Name:</span>
                        <p> {{ $teacher->user->name }}</p>
                    </div>
                    <div class="d-flex" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Email: </span>
                        <h5>{{ $teacher->user->email }}</h5>
                    </div>
                    <div class="d-flex justify-content-around text-start" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Course: </span>
                        <p>{{ $teacher->course->name }}</p>
                    </div>
                    <div class="d-flex justify-content-around text-start" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Shift: </span>
                        <p>{{ $teacher->shift }}</p>
                    </div>
                    <a href="{{ route('admin.teacher.edit', $teacher) }}" class="btn btn-primary">Edit</a>
                  </div>
                  <div class="col" style="border-left: 1px solid rgb(207, 204, 204)" >
                    <div class="d-flex container justify-content-between" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">CNIC: </span>
                        <p class="mx-auto"> {{ $teacher->user->cnic }}</p>
                    </div>
                    <div class="d-flex container justify-content-between" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Phone-No: </span>
                        <p class="mx-auto"> {{ $teacher->user->phone_no }}</p>
                    </div>
                    <div class="d-flex container justify-content-between" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Date of birth: </span>
                        <p class="mx-auto"> {{ $teacher->user->dob }}</p>
                    </div>
                    <div class="d-flex container justify-content-between" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Gender: </span>
                        <p class="mx-auto"> {{ $teacher->user->gender }}</p>
                    </div>

                    <p><span class="fw-bold">Address: </span> {{ $teacher->user->address}}</p>
                  </div>
                </div> --}}
            </div>
        </div>
    </div>
</main>









@endsection
