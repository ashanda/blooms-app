@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">{{ $pageTitle }}</h4>
              <a href="{{ route('campaigns.create') }}" class="btn btn-primary mb-3">Create Campaign</a>
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
                    <th>Name</th>
                    <th>Image</th>
                    <th>Assigned Agent</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($campaigns as $campaign)
                    <tr>
                        <td>{{ $campaign->name }}</td>
                        <td>
                            @if ($campaign->image)
                                <img src="{{ asset('storage/' . $campaign->image) }}" alt="Campaign Image" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ findSalesAgent($campaign->assigned_agent)->name }}</td>
                        <td>
                            <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST" style="display: inline-block;">
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
