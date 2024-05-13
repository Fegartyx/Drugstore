<?php

use App\Http\Controllers\CartController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistoryTransactionController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('/features/users', UserController::class);
    Route::resource('/features/products', ProductController::class);
    Route::resource('/features/categories', CategoryController::class);
    Route::resource('/features/transactions', TransactionController::class);
    Route::resource('/features/history-transactions', HistoryTransactionController::class);
    Route::post('/features/cart-store', [CartController::class, 'store']);
    Route::delete('/features/cart-delete/{id}', [CartController::class, 'destroy']);
    Route::patch('/features/cart-update/{cart}', [CartController::class, 'update'])->name('cart.update');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard-general-dashboard');
})->middleware('auth');

Route::get('/', function () {
    return view('landing-page.main', [
        'products' => Product::all()->take(6),
    ]);
});
