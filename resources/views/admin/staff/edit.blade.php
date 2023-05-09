@extends('admin.layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Edit Staff</h3>
                </div>
                <div class="card-body">
                    <form class="forms-sample " method="POST" action="{{ route('staff.update', $staff->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row p-2">
                            <div class="col-lg-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $staff->name }}" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ $staff->email }}" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-lg-6">
                                <label for="password">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" disabled>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="gender">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                    @foreach(['male', 'female'] as $gender)
                                        <option value="{{ $gender }}" @if($staff->gender == $gender) selected @endif>{{ $gender }}</option>
                                    @endforeach
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row p-2">
                            <div class="col-lg-6">
                                <label for="phone_number">Phone Number</label>
                                <input type="tel" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ $staff->phone_number }}" >

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row p-2 d-flex ">
                            <div class="col-lg-3">
                                <div class="d-flex flex-column ">
                                
                                    <div class="p-1">
                                        <label for="role_id">Role</label>
                                        <select class="form-control @error('role_id') is-invalid @enderror" name="role_id" value="{{ $staff->role_id }}">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" @if($staff->role_id == $role->id) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('role_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row d-flex justify-content-between p-2">
                            <div class="pl-3">
                                <a href="{{ route('staff.index') }}">
                                <button class="btn btn-light mr-2" type="button">Cancel</button>
                                </a>
                            </div>
                            <div class="pr-3">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
