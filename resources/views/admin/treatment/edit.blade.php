@extends('admin.layouts.master')

@section('content')
    <div class="container">
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
                <form action="{{ route('treatment.update', $treatment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                  
                    <div class="form-group">
                        <label for="treatment_code">Treatment Code:</label>
                        <input type="text" name="treatment_code" id="treatment_code" class="form-control" value="{{ $treatment->treatment_code }}">
                    </div>
                  
                    <div class="form-group">
                        <label for="treatment_name">Treatment Name:</label>
                        <input type="text" name="treatment_name" id="treatment_name" class="form-control" value="{{ $treatment->treatment_name }}">
                    </div>
                  
                    <div class="form-group">
                        <label for="treatment_time">Time:</label>
                        <input type="text" name="treatment_time" id="treatment_time" class="form-control" value="{{ $treatment->treatment_time }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="face_value">Face Value:</label>
                        <input type="text" name="face_value" id="face_value" class="form-control" value="{{ $treatment->face_value }}">
                    </div>
                  
                    <div class="form-group">
                        <label for="actual_value">Actual Value:</label>
                        <input type="text" name="actual_value" id="actual_value" class="form-control" value="{{ $treatment->actual_value }}">
                    </div>
                  
                    <div class="form-group">
                        <label for="hospital_charge">Hospital Charge:</label>
                        <input type="text" name="hospital_charge" id="hospital_charge" class="form-control" value="{{ $treatment->hospital_charge }}">
                    </div>
                  
                    <div class="form-group">
                        <label for="agent_fee">Agent Fee:</label>
                        <input type="text" name="agent_fee" id="agent_fee" class="form-control" value="{{ $treatment->agent_fee }}">
                    </div>
                  
                    <div class="form-group">
                        <label for="other_expense">Other Expenses Amount:</label>
                        <input type="text" name="other_expense" id="other_expense" class="form-control" value="{{ $treatment->other_expense }}">
                    </div>
                  
                    <div class="form-group">
                        <label for="note">Note:</label>
                        <textarea class="form-control" id="note" name="note" rows="3">{{ $treatment->note }}</textarea>
                    </div>
                  
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                
              
          </div>
        </div>

    </div>
@endsection