@extends('admin.layouts.master')

@section('content')
<div class="container">
<div class="card">
    <div class="card-header card-header-warning">
      <h4 class="card-title">{{ $pageTitle }}</h4>
      
    </div>
    <div class="card-body table-responsive">
        <form action="{{ route('expense.update', $expenseType->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

           <div class="form-group">
                <label for="name">Expense Type</label>
                <select class="form-control" name="expense_type" required>
                        @foreach ($expenseTypes as $expenseCat)
                <option value="{{ $expenseCat->expence_type }}" {{ $expenseType->expense_type == $expenseCat->expence_type ? 'selected' : '' }}>
                    {{ $expenseCat->expence_type }}
                </option>
            @endforeach
                </select>       
            </div>
            <div class="form-group">
                <label for="name">Amount</label>
                <input type="number" min="0" step="0.00" name="amount" value="{{ $expenseType->amount }}" id="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Date</label>
                <input type="date" name="date" id="date" value="{{ $expenseType->date }}"  class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Expense Type</button>
        </form>
    </div>
</div>
</div>
@endsection