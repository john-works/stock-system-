<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = DB::table('sales')
        ->leftJoin('sale_items', 'sales.id', '=', 'sale_items.sale_id')
        ->select('sales.id', 'sales.reciept_no', 'sales.created_at',
                 DB::raw('COUNT(sale_items.id) as total_items'),
                 DB::raw('SUM(sale_items.subtotal) as total_amount'))
        ->groupBy('sales.id', 'sales.reciept_no', 'sales.created_at')
        ->get();

    return view('sales.index', compact('sales'));
    
    }

    public function create()
{
    $products = Product::all();
    return view('sales.create', compact('products'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    DB::beginTransaction();

    try {
        $validatedItems = [];

        // Step 1: Validate all items first
        foreach ($request->items as $item) {
            $productId = $item['id'];
            $saleQty = $item['qty'];

            // Get total available quantity from purchases
            $availableQty = Purchase::where('product_id', $productId)->sum('qty');

            if ($availableQty == 0) {
                $product = Product::find($productId);
                return redirect()->back()->with('warning', 'No stock available for "' . $product->item_name . '".');
            }

            if ($saleQty > $availableQty) {
                $product = Product::find($productId);
                return redirect()->back()->with('warning', 'Insufficient stock for "' . $product->item_name . '". Available: ' . $availableQty . ', Requested: ' . $saleQty);
            }

            if (($availableQty - $saleQty) <= 5) {
                $product = Product::find($productId);
                return redirect()->back()->with('warning', 'Cannot proceed with sale of "' . $product->item_name . '". Selling ' . $saleQty . ' would leave only ' . ($availableQty - $saleQty) . ' in stock, which is below the minimum threshold.');
            }

            $validatedItems[] = $item;
        }

        // Step 2: Create Sale
        $sale = Sale::create([
            'reciept_no' => $request->reciept_no,
        ]);

        // Step 3: Deduct from purchases and save sale items
        foreach ($validatedItems as $item) {
            $productId = $item['id'];
            $saleQty = $item['qty'];

            // Deduct from the earliest purchases (FIFO)
            $purchases = Purchase::where('product_id', $productId)->orderBy('created_at')->get();
            $remainingQty = $saleQty;

            foreach ($purchases as $purchase) {
                if ($remainingQty == 0) break;

                if ($purchase->qty >= $remainingQty) {
                    $purchase->qty -= $remainingQty;
                    $purchase->save();
                    $remainingQty = 0;
                } else {
                    $remainingQty -= $purchase->qty;
                    $purchase->qty = 0;
                    $purchase->save();
                }
            }

            // Save Sale Item
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $productId,
                'unit' => $item['unit'],
                'price' => $item['price'],
                'qty' => $saleQty,
                'subtotal' => $item['price'] * $saleQty,
            ]);

          // Update stock in products table
    $product = Product::find($request->product_id);
    if ($product) {
        $product->stock += $request->qty;
        $product->save();
    }
}
        DB::commit();
        return redirect()->route('sales.index')->with('success', 'Sale recorded and stock updated successfully.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error saving sale: ' . $e->getMessage());
    }
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {  $sale->load(['items.product']); // Load related items and products
    return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
    public function print($id)
{
    $sale = Sale::with('items.product')->findOrFail($id);
    return view('sales.print', compact('sale'));
}
}
