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
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>Customer ID</th>
                  <th>Name</th>
                  <th>Phone</th>
                   <th>Action</th>
                </thead>
                <tbody>
                    @foreach ( $doc_patients as $doc_patient)
                    <tr>
                        <td>{{ $doc_patient->customer_id }}</td>
                        <td>{{ $doc_patient->name }}</td>
                        <td>{{ $doc_patient->phone }}</td>
                        <td>
                          <a href="{{ url('/patient_data', ['id' => $doc_patient->customer_id]) }}" class="btn btn-primary">View</a>

                      </td>
                      </tr> 
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>


    </div>
@endsection