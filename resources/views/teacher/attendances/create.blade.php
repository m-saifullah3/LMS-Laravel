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
                            <a href="{{ route('teacher.student.attendances.index', $batch) }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    @if (count($batch->enrollments) > 0)
                        <form action="{{ route('teacher.students.attendance.create', $batch) }}" method="post">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                                @error('date')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                
                            </div>

                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Reg. No.</th>
                                        <th>Name</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($batch->enrollments as $enrollment)
                                    <tr>
                                        <td>{{ $enrollment->reg_no }}</td>
                                        <td>{{ $enrollment->student->user->name }}</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="{{ $enrollment->student_id }}"
                                                    id="{{ $enrollment->student_id }}_present" value="1" checked>
                                                <label class="form-check-label" for="{{ $enrollment->student_id }}_present">Present</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input  "  type="radio" name="{{ $enrollment->student_id }}"
                                                    id="{{ $enrollment->student_id }}_absent" value="0">
                                                <label class="form-check-label" for="{{ $enrollment->student_id }}_absent">Absent</label>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                @endforeach

                                    {{-- <tr>
                                        <td>Reg No</td>
                                        <td>Name</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="student_0"
                                                    id="student_0_present" value="1" checked>
                                                <label class="form-check-label" for="student_0_present">Present</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="student_0"
                                                    id="student_0_absent" value="0">
                                                <label class="form-check-label" for="student_0_absent">Absent</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Reg No</td>
                                        <td>Name</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="student_1"
                                                    id="student_1_present" value="1" checked>
                                                <label class="form-check-label" for="student_1_present">Present</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="student_1"
                                                    id="student_1_absent" value="1">
                                                <label class="form-check-label" for="student_1_absent">Absent</label>
                                            </div>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>

                            <input type="submit" value="Submit" class="btn btn-primary">
                        </form>
                    @else
                        <div class="alert alert-danger" role="alert">
                            No record found!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
