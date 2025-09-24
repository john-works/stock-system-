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
                            <form id="stock-form" action="{{ route('expenses.update', $expense->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                            <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="title" class="form-label">Activity / Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $expense->title) }}" required>
                                    </div>

                                   

                                    <div class="col-md-4">
                                        <label for="qty" class="form-label">Amount</label>
                                        <input type="number" class="form-control" id="qty" name="amount" value="{{ old('amount', $expense->amount) }}" required>
                                    </div>
                                
                                   

                                  
                                </div>



                                 <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="description" class="form-label">Description / <Title></Title></label>
                                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $expense->description) }}" required>
                                    </div>

                                   

                                    <div class="col-md-4">
                                        <label for="expense_date" class="form-label">Expense Date</label>
                                        <input type="date" class="form-control" id="expense_date" name="expense_date" value="{{ old('expense_date', $expense->expense_date) }}" required>
                                    </div>
                                
                                   

                                  
                                </div>


                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Back</a>
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
