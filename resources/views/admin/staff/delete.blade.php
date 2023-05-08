@extends('admin.layouts.master')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="card" style="max-width: 350px">
            <div class="card-header">
                <h3>Delete Staff</h3>
            </div>
            <div class="card-footer">
                <form class="forms-sample " method="POST" action="{{ route('staff.destroy', $staff->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <h6>Do you want to permanantly delete {{ $staff->name }}?</h6>

                    <div class="row d-flex justify-content-between p-2">
                        <div class="pl-3">
                            <a href="{{ route('staff.index') }}" class="btn btn-secondary ">Cancel</a>
                        </div>
                        <div class="pr-3">
                            <button type="submit" class="btn btn-danger mr-2">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
