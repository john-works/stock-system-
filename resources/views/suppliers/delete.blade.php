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

    <!-- Centered container -->
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow border-danger border-2">
                <div class="card-header bg-danger text-white text-center">
                    <h4>Confirm Deletion</h4>
                </div>

                <div class="card-body text-center">
                    <p class="fs-5 mb-4">Are you sure you want to delete the following stock item?</p>

                    <ul class="list-group mb-4 text-start">
                        <li class="list-group-item"><strong>Item Name:</strong> {{ $stock->item_name }}</li>
                        <li class="list-group-item"><strong>Unit:</strong> {{ $stock->unit }}</li>
                        <li class="list-group-item"><strong>Quantity:</strong> {{ $stock->qty }}</li>
                        <li class="list-group-item"><strong>Original Price:</strong> {{ $stock->original_price }}</li>
                        <li class="list-group-item"><strong>Selling Price:</strong> {{ $stock->selling_price }}</li>
                    </ul>

                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
