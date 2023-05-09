@extends('admin.layouts.master')

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <div class="alert alert-danger">
                {{ Session::get('message') }}
            </div>
        @endif
        @php
            $grouped_data = $patients_docs->groupBy('appoinment_id');
        @endphp
        
        <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">{{ $pageTitle }}</h4>
              @foreach ($patients_docs as $patients_doc)

              <h6 class="card-title">Patient ID - {{ $patients_doc->customer_id }}</h4>
              <h6 class="card-title">Patient Name -  {{ $patients_doc->customer_name }}</h4>
                @break
            @endforeach
              
            
            @foreach ( $grouped_data as $appointment_id => $group)
          
            <hr class="horizontal dark mt-0">
            <div class="row">
                <div class="col-md-6">
                    <h6>Appointment ID - {{ $appointment_id }}</h6>
                </div>
                <div class="col-md-6 text-right">
                    <h6>Date - {{ $group[0]->created_at }}</h6>
                </div>
            </div>  
            
            @php
                $group_by_document_type = $group->groupBy('document_type');
            @endphp
            @foreach ($group_by_document_type as $document_type => $group_by_type) 
            <hr class="horizontal dark mt-0">
            <h6>Document Type - {{ $document_type }}</h6>
                
                
                    <div class="row mb-5">
                        @foreach ($group_by_type as $patient_doc)
                      <div class="col-md-2">
                        <img src="{{ asset('patient_docs/' . $patient_doc->document) }}" alt="Image 1" class="img-fluid">
                      </div>
                      @endforeach
                    </div>
             
                
            <!--photos--->
            @endforeach
            @endforeach


          </div>


    </div>
@endsection