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
                            <a href="{{ route('teacher.batches') }}" class="btn btn-outline-primary">Towards Batches</a>
                            <a href="{{ route('teacher.students.remarks.create', $batch) }}"
                                class="btn btn-outline-primary">Create Remarks</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    <form action="" method="post" id="form">
                        @csrf
                        <div class="mb-3 row">
                            <label for="week" class="col-sm-1 col-form-label">Week</label>
                            <div class="col-sm-4">
                                <select name="week" id="week" class="form-select">
                                    <option value="" selected hidden disabled>Select the week</option>
                                    @for ($i = 1; $i <= $duration; $i++)
                                        <option value="">Week {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" class="btn btn-primary" id="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                    <p class="text-danger text-center" id="error"></p>

                    <table class="table table-bordered text-center d-none" id="table-bhai">
                        <thead>
                            <tr>
                                <th>Reg. No.</th>
                                <th>Name</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        const formElement = document.querySelector('#form');
        const tbodyElement = document.querySelector('#tbody');
        const dateElement = document.querySelector('#date');
        const tableElement = document.querySelector('#table-bhai');

        formElement.addEventListener('submit', function(e) {
            e.preventDefault();

            const dateElementValue = dateElement.value;
            const token = document.querySelector('input[name="_token"]').value;

            if (dateElementValue == "" || dateElementValue === undefined) {
                alert("Please select the date");
            } else {
                const data = {
                    date: dateElementValue,
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
                        if (result != "NoAttendance") {
                            error.innerHTML = '';
                            tableElement.classList.remove('d-none');
                            tbodyElement.innerHTML = result;
                        } else {
                            tableElement.classList.add('d-none');
                            error.innerHTML = result;
                        }
                    });
            }



        });
    </script>
@endsection
