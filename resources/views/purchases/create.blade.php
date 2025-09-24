@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Quick stats and recent activity')

@section('content')
<div class="row">
{{-- <div id="main"> --}}
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Add Stock Details</h4>
                        <button type="button" id="add-item" class="btn btn-success btn-sm">+ Add Another Item</button>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form  id="purchase-form"action="{{ route('purchases.store') }}" method="POST">
                                @csrf

                                <div id="item-container">
                                    <div class="row item-row border rounded p-2 mb-2">
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="product_id" class="form-label">Select Product</label>
                                          <select name="product_id[]" class="form-control" required>
                                            <option value="">-- Choose Item --</option>
                                                @foreach ($products as $product)
                                               <option value="{{ $product->id }}">{{ $product->item_name }}</option>
                                               @endforeach
                                            </select>
                                            </div>
                                        </div>



                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="supplier_id" class="form-label">Select Supplier</label>
                                          <select name="supplier_id[]" class="form-control" required>
                                            <option value="">-- Choose Supplier --</option>
                                                @foreach ($suppliers as $supplier)
                                               <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                               @endforeach
                                            </select>
                                            </div>
                                        </div>


                                        

                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <input type="text" class="form-control" name="unit[]" placeholder="Eg Kg, Liters" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" class="form-control" name="qty[]"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label>Original Price</label>
                                                <input type="number" class="form-control" name="original_price[]" >
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label>Selling Price</label>
                                                <input type="number" class="form-control" name="selling_price[]"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    {{-- <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button> --}}
                                    
                                     
                                       <div class="col-md-2 col-12">
        <button id="success" type="button" class="btn btn-outline-success btn-lg btn-block">Submit</button>
    </div>
                                    
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

<!-- JS Script to add more item fields -->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('success').addEventListener('click', function (e) {
        Swal.fire({
            icon: "success",
            title: "Confirm Submission",
            text: "Do you want to submit the form?",
            showCancelButton: true,
            confirmButtonText: "Yes, submit",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('purchase-form').submit();
            }
        });
    });
</script>





<script>
    document.getElementById('add-item').addEventListener('click', function () {
        const container = document.getElementById('item-container');
        const firstRow = container.querySelector('.item-row');
        const clone = firstRow.cloneNode(true);
        clone.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(clone);
    });
</script>
@endsection
