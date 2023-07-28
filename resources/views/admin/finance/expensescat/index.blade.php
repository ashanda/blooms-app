@extends('admin.layouts.master')

@section('content')
<div class="container px-0 px-md-4 px-lg-4">
    <div class="card">
        <div class="card-header card-header-warning">
            <h4 class="card-title">{{ $pageTitle }}</h4>
            <a href="{{ route('expense_type.create') }}" class="btn btn-primary mb-3">Create Expense Type</a>
        </div>


        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="card-body table-responsive">
            <table id="data_table" class="table">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $campaign)
                    <tr>
                        <td>{{ $campaign->expence_type }}</td>



                        <td>
                            <a href="{{ route('expense_type.edit', $campaign->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <!-- Button trigger modal -->
                            <form id="deleteForm{{ $campaign->id }}" action="{{ route('expense_type.destroy', $campaign->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $campaign->id }}">Delete</button>
                            </form>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteConfirmationModal{{ $campaign->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Expense Type</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this expense type?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteForm{{ $campaign->id }}').submit()">Delete</button>
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
        @endsection