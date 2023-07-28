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
        <thead class="text-warning">
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">ID</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Name</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Treatment Code</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Treatment Value</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Action</th>
        </thead>
        <tbody>
          @foreach ( $treatments as $treatment)
          <tr>
            <td class="mb-0 text-xs">{{ $treatment->id }}</td>
            <td class="mb-0 text-xs">{{ $treatment->treatment_name }}</td>
            <td class="mb-0 text-xs">{{ $treatment->treatment_code }}</td>
            <td class="mb-0 text-xs">{{ $treatment->actual_value }}</td>
            <td class="mb-0 text-xs">
              <!-- Edit button -->
              <a href="{{ route('treatment.edit', $treatment->id) }}" class="btn btn-primary">Edit</a>
              <!-- Delete button -->
              <!-- Button trigger modal -->
              <form id="deleteForm{{ $treatment->id }}" action="{{ route('treatment.destroy', $treatment->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $treatment->id }}">Delete</button>
              </form>

              <!-- Modal -->
              <div class="modal fade" id="deleteConfirmationModal{{ $treatment->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Treatment</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete this treatment?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteForm{{ $treatment->id }}').submit()">Delete</button>
                    </div>
                  </div>
                </div>
              </div>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>


</div>
@endsection