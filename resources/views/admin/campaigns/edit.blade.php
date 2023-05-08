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
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control-file">
                <img src="{{ asset('storage/' . $campaign->image) }}" alt="Campaign Image" width="200">
            </div>

            <div class="form-group">
                <label for="agent_id">Assigned Agent</label>
                <select name="agent_id" id="agent_id" class="form-control">
                    <option value="">Select Agent</option>
                    @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}" {{ $campaign->agent_id == $agent->id ? 'selected' : '' }}>
                            {{ $agent->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="agent_id">Campaigns Status</label>
                <select name="campaigns_status"  class="form-control">
                    @php
                        if ($campaign->status = 1) {
                            $status = 'Active';
                        }else{
                            $status = 'Deactive';
                        }
        
                    @endphp
                    @if ($campaign->status = 1)

                    <option value="2">{{ "Deactive" }}</option>  
                    @else
                    <option value="1">{{ "Active" }}</option> 
                    @endif
                                     
                    
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Campaign</button>
        </form>
    </div>
</div>
</div>
@endsection