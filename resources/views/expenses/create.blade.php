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
                            <h3>Suppliers</h3>
                            <p class="text-subtitle text-muted"></p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Expenses</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

               




                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Multiple Column</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">

                                         <form  id="purchase-form"action="{{ route('expenses.store') }}" method="POST">
                                @csrf

                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Activities</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="title" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Amount</label>
                                                        <input type="number" id="city-column" class="form-control"
                                                            required name="amount">
                                                    </div>
                                                </div>


                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Description</label>
                                                        <input type="text" id="city-column" class="form-control"
                                                            required name="description">
                                                    </div>
                                                </div>


                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Expense Date</label>
                                                        <input type="date" id="city-column" class="form-control"
                                                            required name="expense_date">
                                                    </div>
                                                </div>
                                                
                                             
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
            </div>

          
        </div>
@endsection
