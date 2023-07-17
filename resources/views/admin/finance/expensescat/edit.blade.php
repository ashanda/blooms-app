@extends('admin.layouts.master')

@section('content')
<div class="container">
<div class="card">
    <div class="card-header card-header-warning">
      <h4 class="card-title">{{ $pageTitle }}</h4>
      
    </div>
    <div class="card-body table-responsive">
        <form action="{{ route('expense_type.update', $expenseType->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Expense Type Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $expenseType->expence_type }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Expense Type</button>
        </form>
    </div>
</div>
</div>
@endsection