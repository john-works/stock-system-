<?php
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('/login');
// });
Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// // // Admin routes
Route::middleware(['auth', 'can:is-admin'])->group(function () {
 Route::get('/home', [HomeController::class, 'index'])->name('home');
 Route::resource('sales', SaleController::class);
 Route::resource('products', ProductController::class);
 Route::resource('suppliers', SupplierController::class);
 Route::get('/reports/daily', [ReportController::class, 'dailyReport'])->name('reports.daily');
Route::get('/reports/weekly', [ReportController::class, 'weeklyReport'])->name('reports.weekly');
Route::get('/reports/monthly', [ReportController::class, 'monthlyReport'])->name('reports.monthly');
Route::get('/reports/annual', [ReportController::class, 'annualReport'])->name('reports.annual');


Route::get('/sales/{id}/print', [SaleController::class, 'print'])->name('sales.print');


Route::resource('expenses', ExpenseController::class);
Route::get('/admin-reports', [ReportController::class, 'reports']);
Route::resource('purchases', PurchaseController::class);
Route::get('/admin-sales', [SaleController::class, 'cashier']);
});

// // Cashier routes
Route::middleware(['auth', 'can:is-cashier'])->group(function () {
  Route::get('/cashier-dashboard', [CashierController::class, 'dashboard']);
  Route::get('/cashier-sales', [CashierController::class, 'sales']);
  Route::get('/cashier-inventory', [CashierController::class, 'inventory']);
});








// Route::resource('suppliers', SupplierController::class);
// Route::resource('products', ProductController::class);
// Route::resource('purchases', PurchaseController::class);
// Route::resource('sales', SaleController::class);
// // Route::resource('customers', CustomerController::class);
// Route::resource('expenses', ExpenseController::class);


// Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
// Route::post('/sales/{id}/mark-printed', [SaleController::class, 'markPrinted'])->name('sales.markPrinted');


// //reports
// Route::get('/reports/daily', [ReportController::class, 'dailyReport'])->name('reports.daily');
// Route::get('/reports/weekly', [ReportController::class, 'weeklyReport'])->name('reports.weekly');
// Route::get('/reports/monthly', [ReportController::class, 'monthlyReport'])->name('reports.monthly');
// Route::get('/reports/annual', [ReportController::class, 'annualReport'])->name('reports.annual');


// Route::get('/sales/{id}/print', [SaleController::class, 'print'])->name('sales.print');

