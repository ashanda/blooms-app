@extends('admin.layouts.master')

@section('content')

<div class="container-fluid py-4">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Appointment</h5>
            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Add your input fields here for editing appointment details -->
                <div class="form-group">
                    <label for="name">Old Treatment</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $appointment->treatment }}" readonly>
                </div>
                <div class="form-group">
                    <label for="name">New Treatment</label>
                    <select class="form-control" id="treatments" name="treatments" multiple required>
                        @foreach (allTreatments() as $treatment)
                           <option value="{{ $treatment->treatment_name }}">{{ $treatment->treatment_name }}</option>
                        @endforeach
                    </select>
                </div>
                <label for="treatments">Doctors</label>
                <div class="input-group mb-3">
                <select class="form-control" id="doctors" name="doctors">
                  <!-- Doctors options will be populated dynamically -->
               </select>
                </div>
                <div class="form-group">
                    <label for="date">Appointment Date</label>
                    <input class="form-control" type="datetime-local" id="appointmentDateTime" name="appointmentDateTime"  required>

                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</div>

@endsection