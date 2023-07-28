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
                <input type="date" class="form-control" id="name" name="date">
            </div>
            <div class="card-body d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">View</button>
            </div>
        </form>
        @if(Route::is('availability.show'))
        <div class="card-header d-flex justify-content-between">
            <h5>@if(isset($date)) Your Availability for: {{ $date }} @endif</h5>
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
                                    <input type="checkbox" id="allTimes" name="time[]" value="{{ $times->time }}" disabled checked>&nbsp;
                                    {{ $times->time }}
                                </label>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete</button>

                </div>
            </form>
        </div>
        @endif
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('treatment.destroy', $treatment->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection