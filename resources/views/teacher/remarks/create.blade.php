@extends('layouts.teacher.main')

@section('title', 'Teacher | Remarks')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Remarks</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('teacher.student.remarks.index', $batch) }}"
                                class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    @if (count($batch->enrollments) > 0)
                        <form action="{{ route('teacher.students.remarks.create', $batch) }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="week" class="col-sm-1 col-form-label">Week</label>
                                <select name="week" id="week" class="form-select @error('week') is-invalid @enderror">
                                    <option value="" selected hidden disabled>Select the week</option>
                                    @for ($i = 1; $i <= $duration; $i++)
                                        <option value="{{ $i }}">Week {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('week')
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
                                                <textarea name="{{ $enrollment->student_id }}" id="remarks" cols="30" rows="1" class="form-control"></textarea>
                                            </td>
                                        </tr>
                                    @endforeach
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
