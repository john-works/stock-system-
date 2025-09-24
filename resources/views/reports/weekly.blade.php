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
                    <h3>Weekly Report</h3>
                    <p class="text-subtitle text-muted">
                        From <strong>{{ $startDate->format('l, d M Y') }}</strong> 
                        to <strong>{{ $endDate->format('l, d M Y') }}</strong>
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Weekly Report</li>
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
                {{-- <thead> Weekly Report<br>{{ $startDate->format('d M') }} - {{ $endDate->format('d M, Y') }}</thead> --}}
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Total Quantity Sold</th>
                        <th>Total Sales</th>
                        <th>Date of Sale (Week)</th> <!-- New Column -->
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
                             <td>{{ number_format($item->total_qty, 0) }} {{ $item->product->unit }}</td>
                            <td>{{ number_format($item->total_sales, 0) }}</td>
                            <td>{{ $startDate->format('d M') }} - {{ $endDate->format('d M, Y') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th>Total</th>
                        <th>{{ $totalQty }}</th>
                        <th><strong>UGX </strong>{{ number_format($totalSales, 2) }}</th>
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
        var printContents = document.getElementById('printSection').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
        location.reload(); // Reload the page to restore the layout
    }
</script>

@endsection
