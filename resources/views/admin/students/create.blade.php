@extends('layouts.admin.main')

@section('title', 'Admin | Add Students')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Add Student</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.students') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('partials.alerts')

                    <form action="{{ route('admin.student.create') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Basic Details</h5>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name') }}"
                                                placeholder="Enter the name">

                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email') }}"
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
                                                id="phone" name="phone" value="{{ old('phone') }}"
                                                placeholder="Enter the phone">

                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cnic">CNIC</label>
                                            <input type="text" class="form-control @error('cnic') is-invalid @enderror"
                                                id="cnic" name="cnic" value="{{ old('cnic') }}"
                                                placeholder="Enter the cnic">

                                            @error('cnic')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="dob">DoB</label>
                                            <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                                id="dob" name="dob" value="{{ old('dob') }}">

                                            @error('dob')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Gender</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male"
                                            value="Male" checked>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female"
                                            value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>

                                    @error('gender')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">

                                </div>

                                <div class="mb-3">
                                    <label for="address">Address</label>
                                    <textarea name="address" class="form-control" id="address" cols="30" rows="3"
                                        placeholder="Enter the address">{{ old('address') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Enrollment Details</h5>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="course">Course</label>
                                            <select name="course" id="course"
                                                class="form-select @error('course') is-invalid @enderror">
                                                <option value="" selected hidden disabled>Select a course</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        {{ old('course') == $course->id ? 'selected' : '' }}>
                                                        {{ $course->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('course')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="batch">Batch</label>
                                            <select name="batch" id="batch"
                                                class="form-select @error('batch') is-invalid @enderror">

                                                @if (old('batch') || old('course'))
                                                <option value="" selected hidden disabled>Select the batch</option>
                                                    @foreach ($batches as $batch)
                                                        @if ($batch->course_id == old('course'))
                                                            <option value="{{ $batch->id }}"
                                                                {{ old('batch') == $batch->id ? 'selected' : '' }}>
                                                                {{ $batch->course->name . ' (' . $batch->class_shift->shift . ')' }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option value="" selected hidden disabled>Select a course to get
                                                        the batches!</option>
                                                @endif

                                            </select>

                                            @error('batch')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="qualification">Qualification</label>
                                            <input type="text"
                                                class="form-control @error('qualification') is-invalid @enderror"
                                                id="qualification" name="qualification"
                                                value="{{ old('qualification') }}"
                                                placeholder="Please enter your qualification">

                                            @error('qualification')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="occupation">Occupation</label>
                                            <input type="text"
                                                class="form-control @error('occupation') is-invalid @enderror"
                                                id="occupation" name="occupation" value="{{ old('occupation') }}"
                                                placeholder="Please enter your occupation">

                                            @error('occupation')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="name">Basic Computer Knowledge (Yes/No)</label>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="basic_computer_knowledge" id="basic_computer_knowledge">
                                                <label class="form-check-label" for="basic_computer_knowledge">Mark to
                                                    Yes</label>
                                            </div>

                                            @error('basic_computer_knowledge')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>
                                    </div>
                                </div>

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
    <script>
        const courseElement = document.querySelector('#course');
        const batchElement = document.querySelector('#batch');

        courseElement.addEventListener('change', function() {
            const courseElementValue = courseElement.value;
            const token = document.querySelector('input[name="_token"]').value;

            const data = {
                courseId: courseElementValue,
                _token: token,
            };

            fetch('{{ route('admin.fetch.batches') }}', {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(result) {
                    batchElement.innerHTML = result;
                });
        });
    </script>
@endsection
