@extends('admin.layouts.master')

@section('content')

<div class="container-fluid py-4">
    
    <div class="card">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone Number</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Treatment</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Appointment Date</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($appointments as $appointment)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">

                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-xs">{{ $appointment->customer_name }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $appointment->customer_phone }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{ $appointment->treatment }}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $appointment->appointment_date_time }}</span>
                  </td>
                  <td class="align-middle">
                    @if ($appointment->visibility == 'closed' && $appointment->status == 'converted' && $appointment->agent_id == Auth::user()->id)
                    <p class="text-xs font-weight-bold mb-0">{{ "Can't edit" }}</p>
                    @else
                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                      Edit
                    </a>
                    @endif
                    
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="mt-4">
      
      </div>
  </div>

@endsection
