@extends('layouts.teacher.main')

@section('title', 'Teacher | Classes')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Classes</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('teacher.batches') }}" class="btn btn-outline-primary">Towards Batches</a>
                            <a href="{{ route('teacher.students.class.create', $batch) }}"
                                class="btn btn-outline-primary">Create Class</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')

                    @if (count($batch->classes) > 0)
                    <table class="table table-bordered text-center  " id="table-bhai">
                        <thead>
                            <tr>
                                <th>Class No.</th>
                                <th>Topic</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($batch->classes as $class)
                                <tr>
                                    <td>{{ $class->class_no }}</td>
                                    <td>{{ $class->topic }}</td>
                                    <td>{{ $class->date }}</td>
                                    <td>Action </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="alert alert-danger">
                            No Record Found!
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </main>
    <script>
        const formElement = document.querySelector('#form');
        const tbodyElement = document.querySelector('#tbody');
        const weekElement = document.querySelector('#week');
        const tableElement = document.querySelector('#table-bhai');

        formElement.addEventListener('submit', function(e) {
            e.preventDefault();

            const weekElementValue = weekElement.value;
            const token = document.querySelector('input[name="_token"]').value;

            if (weekElementValue == "" || weekElementValue === undefined) {
                alert("Please select the week");
            } else {
                const data = {
                    week: weekElementValue,
                    batch_id: {{ $batch->id }},
                    _token: token,
                };

                fetch('{{ route('teacher.fetch.remarks') }}', {
                        method: 'POST',
                        body: JSON.stringify(data),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(result) {
                        if (result != "NoRemarks") {
                            error.innerHTML = '';
                            tableElement.classList.remove('d-none');
                            tbodyElement.innerHTML = result;
                        } else {
                            let element = `<div class="alert alert-danger text-center" role="alert">No record Found</div>`;
                            tableElement.classList.add('d-none');
                            error.innerHTML = element;
                        }
                    });
            }



        });
    </script>
@endsection
