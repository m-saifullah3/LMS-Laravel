@extends('layouts.teacher.main')

@section('title', 'Teacher | Attendance')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Attendance</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('teacher.batches') }}" class="btn btn-outline-primary">Towards Batches</a> 
                            <a href="{{ route('teacher.students.attendance.create', $batch) }}"
                                class="btn btn-outline-primary">Create Attendance</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="date" class="col-sm-1 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="date">
                            </div>
                            <div class="col-sm-1">
                                <input type="submit" class="btn btn-primary" id="submit" value="submit">
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
