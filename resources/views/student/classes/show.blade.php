@extends('layouts.student.main')

@section('title', 'Student | Class')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Show Class</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('student.batch.enrollment', $class->batch) }}"
                                class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Class no </p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $class->class_no }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Topic</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $class->topic }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Description</p>
                        </div>
                        <div class="col-sm-9">
                            @if ($class->description)
                                <p class="text-muted mb-0">{{ $class->description }}</p>
                            @else
                                <p class="text-muted mb-0">N/A</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Tasks</p>
                        </div>
                        <div class="col-sm-9">

                            @if ($class->tasks)
                            <p class="text-muted mb-0">{{ $class->tasks }}</p>
                            @else
                                <p class="text-muted mb-0">N/A</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Date</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $class->date }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">File</p>
                        </div>
                        <div class="col-sm-9">
                            @if ($class->file)
                            {{-- <p class="text-muted mb-0">{{ $class->file }}</p> --}}
                            <a href="{{  asset('class_material/' . $class->file ) }}"
                            class="btn btn-primary btn-sm" download>Download</a>
                            @else
                                <p class="text-muted mb-0">N/A</p>
                            @endif
                        </div>
                    </div>
                    <hr>

                </div>
            </div>
        </div>
    </main>
@endsection
