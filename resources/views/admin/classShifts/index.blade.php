@extends('layouts.admin.main')

@section('title', 'Admin | Shifts')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Shifts</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.shift.create') }}" class="btn btn-outline-primary">Add Shift</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                        @if (count($shifts) > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Shift</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shifts as $shift)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $shift->start->format('h:i A') }}</td>
                                            <td>{{ $shift->end->format('h:i A') }}</td>
                                            <td>{{ $shift->shift }}</td>
                                            <td>
                                                <a href="{{ route('admin.shift.edit', $shift) }}" class="btn btn-primary">Edit</a>
                                            </td>
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
