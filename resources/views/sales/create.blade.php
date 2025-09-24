@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Quick stats and recent activity')

@section('content')

@if (session('success') || session('warning') || session('error'))
    <div style="position: fixed; top: 30%; left: 50%; transform: translate(-50%, -50%);
                z-index: 9999; padding: 20px; border-radius: 10px; min-width: 300px;
                text-align: center; box-shadow: 0 0 15px rgba(0,0,0,0.2);" 
         class="@if(session('success')) bg-success text-white 
                @elseif(session('warning')) bg-warning text-dark 
                @elseif(session('error')) bg-danger text-white 
                @endif">
        @if (session('success'))
            {{ session('success') }}
        @elseif (session('warning'))
            {{ session('warning') }}
        @elseif (session('error'))
            {{ session('error') }}
        @endif
    </div>

    {{-- Optional: auto-dismiss with JavaScript --}}
    <script>
        setTimeout(() => {
            document.querySelector('div[style*="position: fixed"]').remove();
        }, 5000); // disappear after 4 seconds
    </script>
@endif


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
                    <h3>Create Sale</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">Create Sale</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h4 class="card-title">Sale Form</h4></div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="sale-form" action="{{ route('sales.store') }}" method="POST">
                                    @csrf
                                    @php $generatedReceipt = 'RCPT-' . strtoupper(Str::random(6)); @endphp

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label>Receipt No.</label>
                                            <input type="text" name="reciept_no" value="{{ $generatedReceipt }}" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <h5>Select Items</h5>
                                    <div class="row align-items-end">
                                        <div class="col-md-3">
                                            <label for="productSelect">Product</label>
                                            <select id="productSelect" class="form-control">
                                                <option value="">-- Choose Item --</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        data-name="{{ $product->item_name }}"
                                                        data-price="{{ $product->selling_price }}"
                                                        data-unit="{{ $product->unit }}">
                                                        {{ $product->item_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Unit</label>
                                            <input type="text" id="unit" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Price</label>
                                            <input type="number" id="price" class="form-control">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Quantity</label>
                                            <input type="number" id="quantity" class="form-control">
                                        </div>

                                        <div class="col-md-2">
                                            <button type="button" id="addItemBtn" class="btn btn-primary">Add Item</button>
                                        </div>
                                    </div>

                                    <table class="table table-bordered mt-4" id="itemsTable">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>

                                    <div id="selectedItems"></div>

                                    <div class="col-12 d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </form>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const productSelect = document.getElementById('productSelect');
                                        const unitInput = document.getElementById('unit');
                                        const priceInput = document.getElementById('price');
                                        const quantityInput = document.getElementById('quantity');
                                        const addItemBtn = document.getElementById('addItemBtn');
                                        const itemsTable = document.querySelector('#itemsTable tbody');
                                        const selectedItems = document.getElementById('selectedItems');
                                        const selectedIds = new Set();

                                        productSelect.addEventListener('change', function () {
                                            const selected = productSelect.options[productSelect.selectedIndex];
                                            unitInput.value = selected.dataset.unit || '';
                                            if (!priceInput.value) {
                                                priceInput.value = selected.dataset.price || '';
                                            }
                                        });

                                        addItemBtn.addEventListener('click', function () {
                                            const selected = productSelect.options[productSelect.selectedIndex];
                                            const productId = selected.value;
                                            const productName = selected.dataset.name;
                                            const unit = selected.dataset.unit;
                                            const price = parseFloat(priceInput.value);
                                            const qty = parseFloat(quantityInput.value);

                                            if (!productId || !qty || qty <= 0 || !price || price <= 0) {
                                                alert("Please select a valid product, quantity, and price.");
                                                return;
                                            }

                                            if (selectedIds.has(productId)) {
                                                alert("Item already added.");
                                                return;
                                            }

                                            selectedIds.add(productId);
                                            const subtotal = (price * qty).toFixed(2);

                                            const row = document.createElement('tr');
                                            row.innerHTML = `
                                                <td>${productName}</td>
                                                <td>${unit}</td>
                                                <td><input type="number" class="form-control editable-price" data-id="${productId}" value="${price}"></td>
                                                <td><input type="number" class="form-control editable-qty" data-id="${productId}" value="${qty}"></td>
                                                <td class="subtotal" data-id="${productId}">${subtotal}</td>
                                                <td><button type="button" class="btn btn-danger btn-sm remove-btn" data-id="${productId}">Remove</button></td>
                                            `;
                                            itemsTable.appendChild(row);

                                            selectedItems.innerHTML += `
                                                <input type="hidden" name="items[${productId}][id]" value="${productId}" class="item-${productId}">
                                                <input type="hidden" name="items[${productId}][unit]" value="${unit}" class="item-${productId}">
                                                <input type="hidden" name="items[${productId}][price]" value="${price}" class="item-${productId} price-hidden" data-id="${productId}">
                                                <input type="hidden" name="items[${productId}][qty]" value="${qty}" class="item-${productId} qty-hidden" data-id="${productId}">
                                            `;

                                            // Reset selection
                                            productSelect.selectedIndex = 0;
                                            unitInput.value = '';
                                            priceInput.value = '';
                                            quantityInput.value = '';
                                        });

                                        // Remove button
                                        itemsTable.addEventListener('click', function (e) {
                                            if (e.target.classList.contains('remove-btn')) {
                                                const id = e.target.dataset.id;
                                                e.target.closest('tr').remove();
                                                document.querySelectorAll(`.item-${id}`).forEach(input => input.remove());
                                                selectedIds.delete(id);
                                            }
                                        });

                                        // Update subtotal and hidden inputs on edit
                                        itemsTable.addEventListener('input', function (e) {
                                            const id = e.target.dataset.id;
                                            const row = e.target.closest('tr');
                                            const priceInput = row.querySelector('.editable-price');
                                            const qtyInput = row.querySelector('.editable-qty');

                                            const newPrice = parseFloat(priceInput.value) || 0;
                                            const newQty = parseFloat(qtyInput.value) || 0;
                                            const newSubtotal = (newPrice * newQty).toFixed(2);

                                            row.querySelector('.subtotal').textContent = newSubtotal;

                                            document.querySelector(`.price-hidden[data-id="${id}"]`).value = newPrice;
                                            document.querySelector(`.qty-hidden[data-id="${id}"]`).value = newQty;
                                        });
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
