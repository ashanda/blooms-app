@extends('patient.layout.master')

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="confirm">
        <div class="card-body">
            <table id="data_table" class="table container-fluid">
                <thead>
                    <tr class="">
                        <th>Doctor</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Cancel</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timesArr as $time)
                    <form method="POST" action="{{ route('patient.delete') }}">
                        @csrf
                        @method('PUT')
                        <tr class="">
                            <td>{{ $time->name }}</td>
                            <td>{{ $time->email }}</td>
                            <td>{{ $time->date }}</td>
                            <td>{{ $time->time }}</td>
                            <td>
                                <div class="table-actions ">
                                    <input type="submit" value="X" class="btn btn-primary btn-link btn-sm" style=" width:55px;">
                                </div>
                            </td>
                        </tr>
                        <input type="hidden" name="time" value="{{ $time->time }}"/>
                        <input type="hidden" name="appointment_id" value="{{ $time->appointment_id }}"/>
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
