@extends('layouts.teacher.main')

@section('title', 'Teacher | Students')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Students</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('teacher.batches') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @if (count($enrollments) > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Reg. No.</th>
                                    <th>Phone No.</th>
                                    <th>CNIC</th>
                                    <th>Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enrollments as $enrollment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $enrollment->student->user->name }}</td>
                                        <td>{{ $enrollment->reg_no }}</td>
                                        <td>{{ $enrollment->student->user->phone_no }}</td>
                                        <td>{{ $enrollment->student->user->cnic }}</td>
                                        <td>{{ $enrollment->student->user->gender }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
