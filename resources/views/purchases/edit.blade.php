
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
                            <h4 class="mb-0">Edit Purchase Details</h4>
                        </div>
                        <div class="card-body">
                            <form id="pur-form" action="{{ route('purchases.update', $purchase->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                 
{{-- 
                                     <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="product_id" class="form-label">Select Product</label>
                                          <select name="product_id[]" class="form-control" required>
                                            <option value="">-- Choose Item --</option>
                                                @foreach ($products as $product)
                                               <option value="{{ $product->id }}">{{ $product->item_name }}</option>
                                               @endforeach
                                            </select>
                                            </div>
                                        </div> --}}

                                    {{-- <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="supplier_id" class="form-label">Select Supplier</label>
                                          <select name="supplier_id[]" class="form-control" required>
                                            <option value="">-- Choose Supplier --</option>
                                                @foreach ($suppliers as $supplier)
                                               <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                               @endforeach
                                            </select>
                                            </div>
                                        </div> --}}

                                    <div class="col-md-3">
                                        <label for="qty" class="form-label">Unit</label>
                                        <input type="text" class="form-control" id="qty" name="unit" value="{{ old('unit', $purchase->unit) }}" required>
                                    </div>


                                      <div class="col-md-3">
                                        <label for="unit" class="form-label">Qty</label>
                                        <input type="text" class="form-control" id="unit" name="qty" value="{{ old('qty', $purchase->qty) }}" required>
                                    </div>

                                     <div class="col-md-3">
                                        <label for="original_price" class="form-label">Buying Price</label>
                                        <input type="text" class="form-control" id="unit" name="original_price" value="{{ old('original_price', $purchase->original_price) }}" required>
                                    </div>

                                     <div class="col-md-3">
                                        <label for="selling_price" class="form-label">Buying Price</label>
                                        <input type="text" class="form-control" id="selling_price" name="selling_price" value="{{ old('selling_price', $purchase->selling_price) }}" required>
                                    </div>

                                   

                                  
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Back</a>
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
                    document.getElementById('pur-form').submit();
                }
            });
        });
    </script>
</div>
@endsection
