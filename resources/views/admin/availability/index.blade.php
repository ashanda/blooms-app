@extends('admin.layouts.master')

@section('content')
    <div class="container px-0 px-md-4 px-lg-4">
        @if (Session::has('message'))
            <div class="alert alert-danger">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Shift Times</h4>
                <p class="card-category">View shift hours for selected dates</p>
            </div>
            <div class="card-header">
                <h5>Date</h5>
            </div>
            <form class="forms-sample" method="POST" action="{{ route('availability.show',  Auth::user()->id) }}">
                @csrf
                <div class="card-body">
                    <input type="date" class="form-control" id="name" name="date"  >
                </div>
                <div class="card-body d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">View</button>
                </div>
            </form>
            @if(Route::is('availability.show'))
                <div class="card-header d-flex justify-content-between">
                    <h5>@if(isset($date)) Your Availability for:  {{ $date }} @endif</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('availability.delete') }}" method="POST">
                        @csrf
                        <table class="table table-borderless">
                            <tbody>
                                <input type="hidden" name="appointment_id" value="{{ $appointment_id }}">
                                <input type="hidden" name="date" value="{{ $date }}">
                                <tr>
                                    <td class="d-flex btn-group-toggle flex-wrap" data-toggle="buttons">
                                    @foreach($timesArr as $times)
                                        <label class="btn btn-light active" id="check" style="width:33%">
                                            <input type="checkbox" id="allTimes" name="time[]"
                                                value="{{ $times->time }}" disabled checked >&nbsp;
                                                {{ $times->time }}
                                        </label>
                                    @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
