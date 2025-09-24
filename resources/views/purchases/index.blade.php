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
                            <h3>DataTable</h3>
                            <p class="text-subtitle text-muted">For user to check they list</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Simple Datatable
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Supplier Name</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Original Price</th>
                                        <th>Selling Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                                 
        @foreach ($purchases as $purchase)
                                    <tr>

                                        {{-- <td>{{ $purchase->product_id }}</td> --}}
                                        {{-- <td>{{ $purchase->supplier_id }}</td> --}}


                                        <td>{{ $purchase->product->item_name ?? 'N/A' }}</td>
                                        <td>{{ $purchase->supplier->supplier_name ?? 'N/A' }}</td>

                                        <td>{{ $purchase->qty }}</td>
                                        <td>{{ $purchase->unit }}</td>
                                        <td>{{ $purchase->original_price }}</td>
                                        <td>{{ $purchase->selling_price }}</td>
                                       
                                        <td>

                <a href="{{ route('purchases.edit', $purchase->id) }}"> <i class="bi bi-pen"></i> </a>
                  {{--  <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete?')"> <i class="bi bi-trash"></i></button>
                    </form>--}}
                        &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ route('purchases.destroy', $purchase->id) }}"> <i class="bi bi-trash"></i> </a> 
                     
                                        </td>
                                    </tr>
                                  
                                  
          @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>
        </div>
        </div>
    </div>

    
    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="{{asset('assets/js/main.js')}}"></script>

  @endsection