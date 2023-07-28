@extends('admin.layouts.master')

@section('content')
    <div class="container px-0 px-md-4 px-lg-4">
        @if (Session::has('message'))
            <div class="alert alert-danger">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">{{ $pageTitle }}</h4>
              
            </div>
            <div class="card-body table-responsive">
            <form action="{{ route('treatment.store') }}" method="POST">
                @csrf
              
                <div class="form-group">
                  <label for="treatment_code">Treatment Code:</label>
                  <input type="text" name="treatment_code" id="treatment_code" class="form-control">
                </div>
              
                <div class="form-group">
                  <label for="treatment_name">Treatment Name:</label>
                  <input type="text" name="treatment_name" id="treatment_name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="treatment_name">Doctor Name:</label>
                  <select name="doctor_id" id="doctor_id" class="form-control">
                    @foreach ($doctors as $doctor)
                      <option value="{{ $doctor->id}}">{{ $doctor->name }}</option>
                    @endforeach
                    
                  </select>
                  
                </div>
               
                <div class="form-group">
                  <label for="treatment_time">Time:</label>
                  <input type="text" name="treatment_time" id="treatment_time" class="form-control">
                </div>
                <div class="form-group">
                    <label for="face_value">Face Value:</label>
                    <input type="text" name="face_value" id="face_value" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="actual_value">Actual Value:</label>
                    <input type="text" name="actual_value" id="actual_value" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="hospital_value">Hospital Charge:</label>
                    <input type="text" name="hospital_charge" id="hospital_charge" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="agent_fee">Agent Fee:</label>
                    <input type="text" name="agent_fee" id="agent_fee" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="other_expense">Other Expenses Amount:</label>
                    <input type="text" name="other_expense" id="other_expense" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="treatment_value">Note:</label>
                    <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                  </div>
              
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              
          </div>
        </div>

    </div>
@endsection