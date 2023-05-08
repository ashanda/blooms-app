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
                <div class="card-header card-header-primary" >
                    <h4 class="card-title">Create User</h4>
                    <p class="card-category">Register a Doctor or Administrator</p>
                </div>
                <div class="card-body">
                    <form class="forms-sample " method="POST" action="{{ route('staff.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row p-2">
                            <div class="col-lg-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" >

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
                                    class="form-control @error('password') is-invalid @enderror" >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="gender">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender"
                                    value="{{ old('gender') }}" >
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
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
                                    value="{{ old('phone_number') }}" >

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
                                        <select class="form-control @error('role_id') is-invalid @enderror" name="role_id"
                                            >
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
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
