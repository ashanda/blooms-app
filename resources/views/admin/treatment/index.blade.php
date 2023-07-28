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
                            <form action="{{ route('treatment.destroy', $treatment->id) }}" method="POST" style="display: inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                          </td>
                      </tr> 
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>


    </div>
@endsection