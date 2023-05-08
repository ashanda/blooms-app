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
                  <th>ID</th>
                  <th>Name</th>
                  <th>Treatment Code</th>
                  <th>Treatment Value</th>
                  <th>Action</th>
                </thead>
                <tbody>
                    @foreach ( $treatments as $treatment)
                    <tr>
                        <td>{{ $treatment->id }}</td>
                        <td>{{ $treatment->treatment_name }}</td>
                        <td>{{ $treatment->treatment_code }}</td>
                        <td>{{ $treatment->actual_value }}</td>
                        <td>
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