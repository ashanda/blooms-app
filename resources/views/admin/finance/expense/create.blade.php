@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">{{ $pageTitle }}</h4>
              
            </div>
            <div class="card-body table-responsive">
        <form action="{{ route('expense.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Expense Type</label>
                <select class="form-control" name="expense_type" required>
                        @foreach ( $expenseTypes as $expenseType )
                            <option value="{{ $expenseType->expence_type }}">{{ $expenseType->expence_type }}</option>
                        @endforeach
                </select>       
            </div>
            <div class="form-group">
                <label for="name">Amount</label>
                <input type="number" min="0" step="0.00" name="amount" id="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
           

          <button type="submit" class="btn btn-primary">Create Expense Type</button>
        </form>
    </div>
</div>
</div>
@endsection
