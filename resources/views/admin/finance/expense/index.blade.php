@extends('admin.layouts.master')

@section('content')
    <div class="container px-0 px-md-4 px-lg-4">
        <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">{{ $pageTitle }}</h4>
              <a href="{{ route('expense.create') }}" class="btn btn-primary mb-3">Add Expense</a>
            </div>
        

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-body table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($campaigns as $campaign)
                    <tr>
                    <th mb-0 text-xs>Expense Type</th>
                        <td class="mb-0 text-xs">{{ $campaign->expenses_type }}</td>
                        <td class="mb-0 text-xs">{{ $campaign->amount }}</td>
                        <td class="mb-0 text-xs">{{ $campaign->date }}</td>
                        
                        <td>
                            <a href="{{ route('expense.edit', $campaign->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('expense.destroy', $campaign->id) }}" method="POST" style="display: inline-block;">
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
