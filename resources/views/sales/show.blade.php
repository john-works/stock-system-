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
                    <h3>Sale Details</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sales</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4>Receipt No: {{ $sale->reciept_no }}</h4>
                    <p>Date: {{ \Carbon\Carbon::parse($sale->created_at)->format('Y-m-d') }}</p>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                 @foreach($sale->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->product->item_name ?? 'N/A' }}</td>
                <td>{{ $item->qty }}</td>
                                        <td>{{ number_format($item->price, 0) }} UGX</td>
                                        <td>{{ number_format($item->subtotal, 0) }} UGX</td>
                                    </tr>
                                    @php $grandTotal += $item->subtotal; @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total:</th>
                                    <th>{{ number_format($grandTotal, 2) }} UGX</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <a href="{{ route('sales.index') }}" class="btn btn-secondary mt-3">Back to List</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection