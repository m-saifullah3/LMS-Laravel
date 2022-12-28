@extends('layouts.admin.main')

@section('title', 'Admin | Courses')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Add Course</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.courses') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                        @include('partials.alerts')

                        <form action="{{ route('admin.course.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Enter the course name">

                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="duration">Duration</label>
                                <input type="text" class="form-control @error('duration') is-invalid @enderror"
                                    id="duration" name="duration" value="{{ old('duration') }}"
                                    placeholder="Enter the course duration">

                                @error('duration')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="3" placeholder="Enter the course description">{{ old('description') }}</textarea>
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
