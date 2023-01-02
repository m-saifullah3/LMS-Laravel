@extends('layouts.admin.main')

@section('title', 'Admin | Edit Teachers')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Edit Teacher</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.teacher.profile', $teacher) }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('partials.alerts')

                    <form action="{{ route('admin.teacher.edit', $teacher) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name"
                                        value="{{ old('name') ? old('name') : $teacher->user->name }}"
                                        placeholder="Enter the name">

                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email"
                                        value="{{ old('email') ? old('email') : $teacher->user->email }}"
                                        placeholder="Enter the email">

                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone"
                                        value="{{ old('phone') ? old('phone') : $teacher->user->phone_no }}"
                                        placeholder="Enter the phone">

                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="cnic">CNIC</label>
                                    <input type="text" class="form-control @error('cnic') is-invalid @enderror"
                                        id="cnic" name="cnic"
                                        value="{{ old('cnic') ? old('cnic') : $teacher->user->cnic }}"
                                        placeholder="Enter the cnic">

                                    @error('cnic')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="dob">DoB</label>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                        id="dob" name="dob"
                                        value="{{ old('dob') ? old('dob') : $teacher->user->dob }}">

                                    @error('dob')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="qualification">Qualification</label>
                                    <input type="text" class="form-control @error('qualification') is-invalid @enderror"
                                        id="qualification" name="qualification" value="{{ old('qualification') ? old('qualification') : $teacher->qualification }}" placeholder="Please enter your qualification">

                                    @error('qualification')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="course">Course</label>
                                    <select name="course" id="course"
                                        class="form-select @error('course') is-invalid @enderror">
                                        <option value="" selected hidden disabled>Select a course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}"
                                                @if (old('course')) {{ old('course') == $teacher->course_id ? 'selected' : '' }}
                                                @else
                                                {{ $course->id == $teacher->course_id ? 'selected' : '' }}
                                                @endif>
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('course')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="shift">Shift</label>
                                    <select name="shift" id="shift"
                                        class="form-select @error('shift') is-invalid @enderror">
                                        <option value="" selected hidden disabled>Select a shift</option>
                                        @foreach ($shifts as $shift)
                                            <option value="{{ $shift }}"
                                                @if (old('shift')) {{ old('shift') == $teacher->shift ? 'selected' : '' }}
                                                @else
                                                {{ $shift == $teacher->shift ? 'selected' : '' }}
                                                @endif>
                                                {{ $shift }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('shift')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label>Gender</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male"
                                @if (strtolower(old('gender')) == 'male')
                                checked
                                @elseif ($teacher->user->gender == 'Male')
                                checked
                                @endif >
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female"
                                @if (strtolower(old('gender')) == 'female')
                                checked
                                @elseif ($teacher->user->gender == 'Female')
                                checked
                                @endif >
                                <label class="form-check-label" for="female">Female</label>
                            </div>

                            @error('gender')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="picture">Profile Picture</label>
                            <input type="file" class="form-control @error('picture') is-invalid @enderror"
                                id="picture" name="picture">

                            @error('picture')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" id="address" cols="30" rows="3"
                                placeholder="Enter the address">{{ old('address') ? old('address') : $teacher->user->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="name">Status</label>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="status" id="status" @if ($teacher->status == 1) checked @endif>
                                <label class="form-check-label" for="status">Mark to active</label>
                            </div>
                        </div>


                        <div>
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection
