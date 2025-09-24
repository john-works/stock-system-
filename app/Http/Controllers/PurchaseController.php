<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //      // Only admin users can see admin dashboard
    //     if (Gate::allows('is-admin')) {
    //         return view('admin.purchases');
    //     }

    //     // If the user is NOT a cashier
    //     if (Gate::denies('is-cashier')) {
    //         return view('cashier.purchases');
    //     }
        
         $purchases = Purchase::all();
        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $products = Product::all(); // Fetch all products
         $suppliers = Supplier::all(); // Fetch all products

    return view('purchases.create', compact('products', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $count = count($request->product_id);

    for ($i = 0; $i < $count; $i++) {
        \App\Models\Purchase::create([
            'product_id'     => $request->product_id[$i],
            'supplier_id'     => $request->supplier_id[$i],
            'unit'            => $request->unit[$i],
            'qty'             => $request->qty[$i],
            'original_price'  => $request->original_price[$i],
            'selling_price'   => $request->selling_price[$i],
        ]);

        }

    return redirect()->route('purchases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
         $count = count($request->product_id);

    for ($i = 0; $i < $count; $i++) {
        \App\Models\Stock::create([
            'product_id'       => $request->product_id[$i],
            'supplier_id'       => $request->supplier_id[$i],
            'unit'            => $request->unit[$i],
            'qty'             => $request->qty[$i],
            'original_price'  => $request->original_price[$i],
            'selling_price'   => $request->selling_price[$i],
        ]);
    }

    return redirect()->route('purchases.index')->with('success', 'Stock items added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
            // $purchase = Purchase::findOrFail($id);
            $products = Product::all(); //
            $suppliers = Supplier::all(); //
          return view('purchases.edit', compact('purchase', 'products', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
          $request->validate([
      
        'qty' => 'required',
        'unit' => 'required',
        'original_price' => 'required',
        'selling_price' => 'required',
    ]);

    $purchase->update($request->all());

    return redirect()->route('purchases.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

             return redirect()->route('purchases.index');
    }
}
