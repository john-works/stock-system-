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
                            <h3>Report</h3>
                            <p class="text-subtitle text-muted"></p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Report</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

               
<div class="container">
    <h3>Daily Report - {{ $today->toFormattedDateString() }}</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Total Quantity Sold</th>
                <th>Total Sales</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotalQty = 0;
                $grandTotalSales = 0;
            @endphp

            @foreach ($sales as $item)
                @php
                    $grandTotalQty += $item->total_qty;
                    $grandTotalSales += $item->total_sales;
                @endphp
                <tr>
                    
                    <td>{{ $item->product->item_name ?? 'Unknown' }}</td>
                     <td>{{ number_format($item->total_qty, 0) }} {{ $item->product->unit }}</td>
                    <td>UGX{{ number_format($item->total_sales, 0) }}</td>
                </tr>
            @endforeach

            <!-- Grand Total Row -->
            <tr>
                <th>Total</th>
                <th>{{ $grandTotalQty }}</th>
                <th>UGX{{ number_format($grandTotalSales, 2) }}</th>
            </tr>
        </tbody>
    </table>
</div>

@endsection
