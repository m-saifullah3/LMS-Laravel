@extends('layouts.admin.main')

@section('title', 'Admin | Add Shift')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Add Shift</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.shifts') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                        @include('partials.alerts')

                        <form action="{{ route('admin.shift.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="start">Start Time</label>
                                <input type="time" class="form-control @error('start') is-invalid @enderror"
                                    id="start" name="start" value="{{ old('start') }}" placeholder="Enter the course start">

                                @error('start')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="end">End Time</label>
                                <input type="time" class="form-control @error('end') is-invalid @enderror"
                                    id="end" name="end" value="{{ old('end') }}" placeholder="Enter the course end">

                                @error('end')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="shift">Shift</label>
                                <input type="text" class="form-control @error('shift') is-invalid @enderror"
                                    id="shift" name="shift" value="{{ old('shift') }}"
                                    placeholder="Enter the course shift">

                                @error('shift')
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
