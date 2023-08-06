@extends('admin.layouts.master')

@section('content')
<div class="container px-0 px-md-4 px-lg-4">
    <div class="card">
        <div class="card-header card-header-warning">
            <h4 class="card-title">{{ $pageTitle }}</h4>
        </div>


        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="card-body table-responsive">
            <table id="data_table" class="table">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invoice number</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Treatment</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bill Value</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Type</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Paid amount</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Balance</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">issued_by</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                        <td class="mb-0 text-xs px-4">{{ $invoice->invoice_id }}</td>
                        <td class="mb-0 text-xs px-4">{{ $invoice->treatment }}</td>
                        <td class="mb-0 text-xs px-4">{{ $invoice->payment_type }}</td>
                        <td class="mb-0 text-xs px-4">{{ $invoice->total }}</td>
                        <td class="mb-0 text-xs px-4">{{ $invoice->pay_amount }}</td>
                        <td class="mb-0 text-xs px-4">{{ $invoice->balance }}</td>
                        <td class="mb-0 text-xs px-4">{{ $invoice->issued_by }}</td>
                        <td class="mb-0 text-xs px-4">{{ $invoice->created_at }}</td>
                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endsection