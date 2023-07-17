@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">{{ $pageTitle }}</h4>
              
            </div>
            <div class="card-body table-responsive">
        <form action="{{ route('expense_type.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Expense Type Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

           

          <button type="submit" class="btn btn-primary">Create Expense Type</button>
        </form>
    </div>
</div>
</div>
@endsection
