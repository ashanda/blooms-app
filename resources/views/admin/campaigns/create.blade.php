@extends('admin.layouts.master')

@section('content')
<div class="container px-0 px-md-4 px-lg-4">
        <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">{{ $pageTitle }}</h4>
              
            </div>
            <div class="card-body table-responsive">
        <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Campaign Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control-file" style="font-size: 12px;">
            </div>

            <div class="form-group">
                <label for="agent_id">Assigned Agent</label>
                <select name="agent_id" id="agent_id" class="form-control">
                    
                    @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Campaign</button>
        </form>
    </div>
</div>
</div>
@endsection
