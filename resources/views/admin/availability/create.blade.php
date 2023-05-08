@extends('admin.layouts.master')

@section('content')
    <div class="container">
        @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
        @endif
        @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
        @endforeach
        <form class="forms-sample" method="POST" action="{{ route('availability.store') }}">
            @csrf
            <div class="card">
                <div class="card-header card-header-primary" >
                    <h4 class="card-title">Availability</h4>
                    <p class="card-category">Register your shift times</p>
                </div>
                <div class="card-header">
                    <h5>Date</h5>
                </div>
                <div class="card-body">
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="name" name="date">
                    @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="card-header d-flex justify-content-between">
                    <h5>Time</h5>
                    <div>
                        <div class="btn btn-secondary btn-sm pb-0">
                            <label for="checkMorn">
                            <input type="checkbox" id="checkMorn" name="checkMorn" class="form-input p-2" >
                            Morning
                            </label>
                        </div>
                        <div class="btn btn-secondary btn-sm pb-0">
                            <label for="checkArvo">
                            <input type="checkbox" id="checkArvo" name="checkArvo" class="form-input p-2" >
                            Afternoon
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                @for($hour = 8; $hour < 21; $hour++)
                                    <td class="d-flex btn-group-toggle" data-toggle="buttons">
                                        @for($minute = 0; $minute < 6; $minute+=2)
                                            <label class="btn btn-light" id="check" style="width:100%">
                                                <input type="checkbox" id="allTimes" name="time[]" value="{{ $hour }}:{{ $minute }}0" >&nbsp;
                                                {{ $hour }}:{{ $minute }}0
                                            </label>
                                        @endfor
                                    </td>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection