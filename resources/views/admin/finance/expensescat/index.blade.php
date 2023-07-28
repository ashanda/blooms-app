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
                            <form action="{{ route('expense_type.destroy', $campaign->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this campaign?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
