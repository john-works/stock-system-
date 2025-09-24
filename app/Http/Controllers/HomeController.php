<?php

namespace App\Http\Controllers;
use App\Models\Expense;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
     {

    //      // Only admin users can see admin dashboard
        if (Gate::allows('is-admin')) {
            
         $total_purchases =Purchase::count();
             $total_sales =Sale::count();
              //$total_purchases =Purchase::count();
            $total_suppliers =Supplier::count();
            $total_expenses =Expense::count();
            $total_users =User::count();

            $data=[
               
                        'total_purchases'=>$total_purchases,
                        'total_sales'=>$total_sales,
                        'total_suppliers'=>$total_suppliers,
                        'total_expenses'=> $total_expenses,
                         'total_users'=> $total_users,
                


                 ];



        return view('home', compact('data'));
        }

    //     // If the user is NOT a cashier
         if (Gate::allows('is-cashier')) {
            $total_purchases =Purchase::count();
             $total_sales =Sale::count();
              //$total_purchases =Purchase::count();
            $total_suppliers =Supplier::count();
            $total_expenses =Expense::count();
            $total_users =User::count();

            $data=[
               
                        'total_purchases'=>$total_purchases,
                        'total_sales'=>$total_sales,
                        'total_suppliers'=>$total_suppliers,
                        'total_expenses'=> $total_expenses,
                         'total_users'=> $total_users,
                


                 ];



        return view('home', compact('data'));
         }
        //     $total_purchases =Purchase::count();
        //      $total_sales =Sale::count();
        //       //$total_purchases =Purchase::count();
        //     $total_suppliers =Supplier::count();
        //     $total_expenses =Expense::count();
        //     $total_users =User::count();

        //     $data=[
               
        //                 'total_purchases'=>$total_purchases,
        //                 'total_sales'=>$total_sales,
        //                 'total_suppliers'=>$total_suppliers,
        //                 'total_expenses'=> $total_expenses,
        //                  'total_users'=> $total_users,
                


        //          ];



        // return view('home', compact('data'));
    }
}
