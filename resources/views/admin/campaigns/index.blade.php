@extends('admin.layouts.master')

@section('content')
    <div class="container px-0 px-md-4 px-lg-4">
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
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Image</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Assigned Agent</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($campaigns as $campaign)
                    <tr>
                        <td class="mb-0 text-xs">{{ $campaign->name }}</td>
                        <td class="mb-0 text-xs">
                            @if ($campaign->image)
                                <img src="{{ asset('campaing_image/' . $campaign->image) }}" alt="Campaign Image" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="mb-0 text-xs">{{ findSalesAgent($campaign->assigned_agent)->name }}</td>
                        @if ($campaign->status = 1)

                        <td class="mb-0 text-xs">{{ 'Active' }}</td>
                        @else
                        <td class="mb-0 text-xs">{{ 'Deactive' }}</td>
                        @endif
                        
                        <td class="mb-0 text-xs">
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
