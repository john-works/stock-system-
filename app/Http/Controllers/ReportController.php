<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
 use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function dailyReport()
    {
        $today = Carbon::today();

        $sales = SaleItem::whereDate('created_at', $today)
            ->select('product_id', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(subtotal) as total_sales'))
            ->groupBy('product_id')
            ->with('product')
            ->get();

        return view('reports.daily', compact('sales', 'today'));
    }



    public function weeklyReport()
    {
       $startDate = Carbon::now()->startOfWeek();
    $endDate = Carbon::now()->endOfWeek();

    $sales = SaleItem::whereBetween('created_at', [$startDate, $endDate])
        ->select('product_id', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(subtotal) as total_sales'))
        ->with('product')
        ->groupBy('product_id')
        ->get();

    return view('reports.weekly', compact('sales', 'startDate', 'endDate'));
    }


    public function monthlyReport()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $sales = SaleItem::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select('product_id', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(subtotal) as total_sales'))
            ->groupBy('product_id')
            ->with('product')
            ->get();

        return view('reports.monthly', compact('sales', 'month', 'year'));
    }

    public function annualReport()
    {
        $year = Carbon::now()->year;

        $sales = SaleItem::whereYear('created_at', $year)
            ->select('product_id', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(subtotal) as total_sales'))
            ->groupBy('product_id')
            ->with('product')
            ->get();

        return view('reports.annual', compact('sales', 'year'));
    }


}
