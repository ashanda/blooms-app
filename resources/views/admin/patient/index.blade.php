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
              <table id="data_table" class="table table-hover">
                <thead class="text">
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer ID</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
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