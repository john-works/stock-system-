@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Quick stats and recent activity')

@section('content')
<div class="row">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Sales List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sales</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Sales Records</h4>
                    <a href="{{ route('sales.create') }}" class="btn btn-primary">+ Add New Sale</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($sales->count())
                        <table class="table table-striped" id="salesTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receipt No</th>
                                    <th>Date</th>
                                    <th>Total Items</th>
                                    <th>Total Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sale->reciept_no }}</td>
                                        <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('Y-m-d') }}</td>
                                        <td>{{ $sale->total_items }}</td>
                                        <td>{{ number_format($sale->total_amount, 2) }} UGX</td>
                                        <td>
                                            <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-info">View</a>
                                            <a href="{{ route('sales.print', $sale->id) }}" class="btn btn-sm btn-secondary" target="_blank">Print</a>
                                        
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No sales found.</p>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
