@extends('layouts.student.main')

@section('title', 'Student | Remarks')

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
                            <a href="{{ route('student.batch.enrollment', $batch) }}" class="btn btn-outline-primary">Back</a>

                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @if (count($remarks) > 0)
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Week</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($remarks as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->week }}</td>
                                    <td>{{ $item->remarks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="alert alert-danger text-center" role="alert">No record Found</div>
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
                            let element =
                                `<div class="alert alert-danger text-center" role="alert">No record Found</div>`;
                            tableElement.classList.add('d-none');
                            error.innerHTML = element;
                        }
                    });
            }



        });
    </script>
@endsection
