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
                <p class="card-category">Manage Doctors, Accountants, Assistants, Sales Agents and Admins</p>
            </div>
            <div class="card-body">
                <table id="data_table" class="table container-fluid px-0 px-md-4 px-lg-4">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIC</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Joining Date</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staff as $member)
                        <tr>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <div class="mb-0 text-xs">
                                        {{ $member->name }}
                                    </div>
                                </div>
                            </td>
                            <td class="mb-0 text-xs">{{ $member->email }}</td>
                            <td class="mb-0 text-xs">{{ $member->phone_number }}</td>
                            <td class="mb-0 text-xs">{{ $member->nic }}</td>
                            <td class="mb-0 text-xs">{{ $member->joining_date }}</td>
                            <td class="mb-0 text-xs">{{ ucfirst($member->role->name) }}</td>
                            <td class="mb-0 text-xs">
                                <div class="table-actions">
                                    <a href="{{ route('staff.edit', $member->id) }}">
                                        <button type="button" class="btn btn-sm btn-primary">
                                            <i class="material-icons" style="font-size: inherit;">edit</i>
                                        </button>
                                    </a>
                                    <a href="{{ route('staff.show', $member->id) }}">
                                        <button type="button" class="btn btn-sm btn-danger">
                                            <i class="material-icons" style="font-size: inherit;">delete</i>
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