@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header card-header-warning">
            <h4 class="card-title">{{ $pageTitle }}</h4>

        </div>
        <div class="card-body table-responsive">
            <form action="{{ route('campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Campaign Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $campaign->name }}">
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $campaign->start_date }}">
                </div>

                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $campaign->end_date }}">
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                    <img src="{{ asset('campaign_image/' . $campaign->image) }}" alt="Campaign Image" width="200">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ $campaign->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="agent_id">Assigned Agent</label>
                    <select name="agent_id" id="agent_id" class="form-control">
                        <option value="">Select Agent</option>
                        @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}" {{ $campaign->assigned_agent == $agent->id ? 'selected' : '' }}>
                            {{ $agent->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="assign_budget">Assign Budget</label>
                    <input type="number" name="assign_budget" id="assign_budget" class="form-control" value="{{ $campaign->assign_budget }}">
                </div>

                <div class="form-group">
                    <label for="campaigns_status">Campaigns Status</label>
                    <select name="campaigns_status" class="form-control">
                        @php
                        if ($campaign->status == 1) {
                        $status = 'Active';
                        } else {
                        $status = 'Deactive';
                        }
                        @endphp

                        <option value="1" {{ $status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="2" {{ $status == 'Deactive' ? 'selected' : '' }}>Deactive</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Update Campaign</button>
            </form>

        </div>
    </div>
</div>
@endsection