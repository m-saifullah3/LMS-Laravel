@extends('layouts.admin.main')

@section('title', 'Admin | Batches')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Batches</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.batch.create') }}" class="btn btn-outline-primary">Add Batch</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                        @if (count($batches) > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Course</th>
                                        <th>Teacher</th>
                                        <th>Shift</th>
                                        <th>Starting Date</th>
                                        <th>Ending Date</th>
                                        <th>Seats</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($batches as $batch)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $batch->course->name }}</td> 
                                            <td>{{ $batch->teacher->user->name }}</td> 
                                            <td>{{ $batch->class_shift->shift }}</td>
                                            <td>{{ $batch->starting_date->format('d-M-Y') }}</td>
                                            <td>{{ $batch->ending_date->format('d-M-Y') }}</td>
                                            <td>{{ $batch->seats }}</td>
                                            <td>
                                                @if ($batch->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.batch.edit', $batch) }}"
                                                    class="btn btn-primary">Edit</a>
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
