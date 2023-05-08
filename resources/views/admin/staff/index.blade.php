@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Staff</h4>
                    <p class="card-category">Manage Doctors or Administrators</p>
                </div>
                <div class="card-body">
                    <table id="data_table" class="table container-fluid">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th> 
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staff as $member)
                                <tr>
                                    <td>
                                        <div class="d-flex  justify-content-between">
                                            <div class="">
                                                {{ $member->name }}
                                            </div>
                                            
                                        </div>
                                    </td>
                                    
                                    <td>{{ $member->email }}</td>
                                    
                                    <td>{{ $member->phone_number }}</td>
                                    <td>{{ ucfirst($member->role->name) }}</td>
                                    <td>
                                        <div class="table-actions ">
                                            <a href="{{ route('staff.edit', $member->id) }}" >
                                                <button type="button" class="btn bg-gradient-info">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                            </a>
                                            <a href="{{ route('staff.show', $member->id) }}">
                                                <button type="button" class="btn bg-gradient-danger">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

