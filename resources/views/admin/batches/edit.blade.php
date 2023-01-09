@extends('layouts.admin.main')

@section('title', 'Admin | Edit Batch')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Edit Batch</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.batches') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('partials.alerts')

                    <form action="{{ route('admin.batch.edit', $batch) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="course">Course</label>
                            <select name="course" id="course" class="form-select @error('course') is-invalid @enderror">
                                <option value="" selected hidden disabled>Select a course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        @if (old('course')) {{ old('course') == $course->id ? 'selected' : '' }} @else {{ $batch->course_id == $course->id ? 'selected' : '' }} @endif>
                                        {{ $course->name }}</option>
                                @endforeach
                            </select>

                            @error('course')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="teacher">Teacher</label>
                            <select name="teacher" id="teacher"
                                class="form-select @error('teacher') is-invalid @enderror">

                                @if (old('teacher') || old('course'))
                                    <option value="" selected hidden disabled>Select the teacher</option>
                                    @foreach ($teachers as $teacher)
                                        @if ($teacher->course_id == old('course'))
                                            <option value="{{ $teacher->id }}"
                                                {{ old('teacher') == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->user->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($teachers as $teacher)
                                        @if ($teacher->course_id == $batch->course_id)
                                            <option value="{{ $teacher->id }}"
                                                @if (old('teacher')) {{ old('teacher') == $teacher->id ? 'selected' : '' }} @else {{ $batch->teacher_id == $teacher->id ? 'selected' : '' }} @endif>
                                                {{ $teacher->user->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>

                            @error('teacher')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="shift">Shift</label>
                            <select name="shift" id="shift" class="form-select @error('shift') is-invalid @enderror">
                                <option value="" selected hidden disabled>Select a shift</option>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}"
                                        @if (old('shift')) {{ old('shift') == $shift->id ? 'selected' : '' }} @else {{ $batch->class_shift_id == $shift->id ? 'selected' : '' }} @endif>
                                        {{ $shift->shift }}</option>
                                @endforeach
                            </select>

                            @error('shift')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="starting_date">Starting Date</label>
                            <input type="date" class="form-control @error('starting_date') is-invalid @enderror"
                                id="starting_date" name="starting_date"
                                value="{{ old('starting_date') ? old('starting_date') : $batch->starting_date->format('Y-m-d') }}">

                            @error('starting_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ending_date">Ending Date</label>
                            <input type="date" class="form-control @error('ending_date') is-invalid @enderror"
                                id="ending_date" name="ending_date"
                                value="{{ old('ending_date') ? old('ending_date') : $batch->ending_date->format('Y-m-d') }}">

                            @error('ending_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="seats">Seat</label>
                            <input type="number" class="form-control @error('seats') is-invalid @enderror" id="seats"
                                name="seats" value="{{ old('seats') ? old('seats') : $batch->seats }}">

                            @error('seats')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name">Status</label>

                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="" selected hidden disabled>Select a status</option>
                                @foreach ($statuses as $key => $value)
                                    <option value="{{ $key }}"
                                        @if (old('status')) {{ old('status') == $key ? 'selected' : '' }} @else {{ $batch->status == $key ? 'selected' : '' }} @endif>
                                        {{ $value }}</option>
                                @endforeach
                            </select>

                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
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
        const teacherElement = document.querySelector('#teacher');

        courseElement.addEventListener('change', function() {
            const courseElementValue = courseElement.value;
            const token = document.querySelector('input[name="_token"]').value;

            const data = {
                courseId: courseElementValue,
                _token: token,
            };

            fetch('{{ route('admin.fetch.teachers') }}', {
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
                    teacherElement.innerHTML = result;
                });
        });
    </script>
@endsection
