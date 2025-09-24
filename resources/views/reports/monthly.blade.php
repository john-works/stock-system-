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
                    <h3>Monthly Report</h3>
                    <p class="text-subtitle text-muted">
                        For <strong>{{ $month }} {{ $year }}</strong>
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Monthly Report</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="mb-3">
                <button onclick="printReport()" class="btn btn-primary">Print</button>
            </div>

            <div id="printSection">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Total Quantity Sold</th>
                            <th>Total Sales</th>
                            <th>Month</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalQty = 0;
                            $totalSales = 0;
                        @endphp
                        @foreach ($sales as $item)
                            @php
                                $totalQty += $item->total_qty;
                                $totalSales += $item->total_sales;
                            @endphp
                            <tr>
                                <td>{{ $item->product->item_name ?? 'Unknown' }}</td>
                                <td>{{ number_format($item->total_qty) }} {{ $item->product->unit }}</td>
                                <td>UGX {{ number_format($item->total_sales, 0) }}</td>
                                <td>{{ $month }} {{ $year }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <th>{{ number_format($totalQty) }}</th>
                            <th><strong>UGX</strong> {{ number_format($totalSales, 2) }}</th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function printReport() {
        const printContents = document.getElementById('printSection').innerHTML;
        const originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
@endsection
