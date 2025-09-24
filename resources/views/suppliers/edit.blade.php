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

    <!-- Full-height flexbox centered container -->
    <div class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="card shadow border-0">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">Edit Stock Item</h4>
                        </div>
                        <div class="card-body">
                            <form id="stock-form" action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="item_name" class="form-label">Supplier Name</label>
                                        <input type="text" class="form-control" id="item_name" name="supplier_name" value="{{ old('supplier_name', $supplier->supplier_name) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="unit" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="unit" name="phone" value="{{ old('phone', $supplier->phone) }}" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="qty" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="qty" name="location" value="{{ old('location', $supplier->location) }}" required>
                                    </div>

                                   

                                  
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
                                    <button id="success" type="button" class="btn btn-success">Update Item</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 for confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('success').addEventListener('click', function () {
            Swal.fire({
                icon: "question",
                title: "Confirm Update",
                text: "Do you want to update this item?",
                showCancelButton: true,
                confirmButtonText: "Yes, update",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('stock-form').submit();
                }
            });
        });
    </script>
</div>
@endsection
