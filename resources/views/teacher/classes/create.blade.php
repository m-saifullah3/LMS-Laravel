@extends('layouts.teacher.main')

@section('title', 'Teacher | Create Class')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Create Class # {{ count($batch->classes) + 1 }}</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('teacher.student.classes.index', $batch) }}"
                                class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    <form action="{{ route('teacher.students.class.create', $batch) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="date" class="col-sm-1 col-form-label">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                                id="date" value="{{ old('date') }}">

                            @error('date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="class_no" class="col-sm-1 col-form-label">Class Number</label>
                            <p class="form-control">{{ count($batch->classes) + 1 }}</p>
                        </div> --}}


                        <div class="mb-3">
                            <label for="topic" class="col-sm-1 col-form-label">Topic</label>
                            <input type="text" class="form-control @error('topic') is-invalid @enderror" name="topic"
                                id="topic" placeholder="Enter today topic" value="{{ old('topic') }}">

                            @error('topic')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="desc" class="col-sm-1 col-form-label">Description</label>
                            <textarea name="desc" id="desc" cols="30" rows="2" placeholder="Enter description"
                                class="form-control @error('desc') is-invalid @enderror">{{ old('desc') }}</textarea>

                            @error('desc')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tasks" class="col-sm-1 col-form-label">Tasks</label>
                            <textarea name="tasks" id="tasks" cols="30" rows="2" placeholder="Enter task"
                                class="form-control @error('tasks') is-invalid @enderror">{{ old('tasks') }}</textarea>

                            @error('tasks')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="file" class="col-sm-1 col-form-label">Class Material</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file"
                                id="file">

                            @error('file')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="submit" value="Submit" class="btn btn-primary">
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection
