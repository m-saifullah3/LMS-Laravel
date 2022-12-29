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
                                        <option value="{{ $course->id }}" {{ old('course') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                                    @endforeach
                                </select>
    
                                @error('course')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="shift">Shift</label>
                                <select name="shift" id="shift" class="form-select @error('shift') is-invalid @enderror">
                                    <option value="" selected hidden disabled>Select a shift</option>
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}" {{ old('shift') == $shift->id ? 'selected' : '' }}>{{ $shift->shift }}</option>
                                    @endforeach
                                </select>
    
                                @error('shift')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="starting_date">Starting Date</label>
                                <input type="date" class="form-control @error('starting_date') is-invalid @enderror" id="starting_date" name="starting_date" value="{{ old('starting_date') }}">
    
                                @error('starting_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="ending_date">Ending Date</label>
                                <input type="date" class="form-control @error('ending_date') is-invalid @enderror" id="ending_date" name="ending_date" value="{{ old('ending_date') }}">
    
                                @error('ending_date')
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
@endsection
