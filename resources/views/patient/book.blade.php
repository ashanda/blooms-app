@extends('patient.layout.master')

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif

    @if (!isset($dateChosen))
        <div class="status">
            <form method="POST" action="{{ route('patient.show') }}">
                @csrf
                <h3>Select the date for your appointment</h3>
                <div class="form-body">
                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" />
                    @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input style="margin-top: 1rem" type="submit" class="btn btn-primary" value="Next" />
                </div>
            </form>
        </div>
    @endif

    @if (isset($timesArr))
        <div class="time-layout">
            <form method="POST" action="{{ route('patient.viewDoctors') }}"
                class="d-flex flex-column justify-content-center">
                @csrf
                <h3 class="align-self-center">Select the time for your appointment</h3>
                <table id="data_table" class="table table-borderless">
                    <tbody>
                        <tr>
                            <div class="d-flex btn-group-toggle flex-wrap" data-toggle="buttons">
                                @foreach ($timesArr as $times)
                                    <label onclick="registerChecked()" class="btn btn-light" id="check"
                                        style="width: 32%; margin: 2px">
                                        <input type="checkbox" id="allTimes" name="time[]" value="{{ $times->time }}" />
                                        {{ $times->time }}
                                    </label>

                                @endforeach
                            </div>
                            <input type="hidden" value="{{ $dateChosen }}" name="date" />
                        </tr>
                    </tbody>
                </table>
                <input type="submit" value="Next" class="btn btn-primary"/>
            </form>
        </div>
    @endif

    @if (isset($availableDoctors))
        <div class="games">
            <h3 style="align-self: center">Select the Doctor for your appointment</h3>
            @foreach ($availableDoctors as $doctor)
                <form method="POST" action="{{ route('patient.update') }}" class="d-flex justify-content-center">
                    @csrf 
                    @method('PUT')
                    <div class="card">
                        <input type="hidden" name="id" value="{{ $doctor->id }}" />
                        <div class="card-info">
                            <p>Name: {{ $doctor->name }}</p>
                            <p>Email: {{ $doctor->email }}</p>
                            <p>Gender: {{ $doctor->gender }}</p>
                            <p>Specialisation: {{ $doctor->department }}</p>
                        </div>
                        <div>
                            <input type="submit" value="Book" class="btn btn-primary"/>
                        </div>
                        <input type="hidden" value="{{ $timeChosen }}" name="time" />
                        <input type="hidden" value="{{ $dateChosen }}" name="date" />
                    </div>
                </form>
            @endforeach
        </div>
    @endif
@endsection
