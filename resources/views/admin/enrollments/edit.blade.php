@extends('layouts.admin.main')

@section('title', 'Admin | Edit Enrollment')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Edit Enrollment</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.student.profile', $enrollment->student) }}"
                                class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('partials.alerts')

                    <form action="{{ route('admin.enrollment.edit', $enrollment) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="course">Course</label>
                                    <select name="course" id="course"
                                        class="form-select @error('course') is-invalid @enderror">
                                        <option value="" selected hidden disabled>Select a course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}"
                                                @if (old('course')) {{ old('course') == $course->id ? 'selected' : '' }}
                                                @else
                                                {{ $enrollment->batch->course_id == $course->id ? 'selected' : '' }} @endif>
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
                                            @foreach ($batches as $batch)
                                                @if ($batch->id == $enrollment->batch_id)
                                                    <option value="{{ $batch->id }}"
                                                        {{ old('batch') == $batch->id ? 'selected' : '' }}>
                                                        {{ $batch->course->name . ' (' . $batch->class_shift->shift . ')' }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('batch')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
