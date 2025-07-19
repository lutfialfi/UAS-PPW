<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;

// --------------------
// Halaman utama
// --------------------
Route::get('/', function () {
    return redirect()->route('products.index');
});

// --------------------
// Login & Register
// --------------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --------------------
// Rute yang butuh login
// --------------------
Route::middleware('auth')->group(function () {

    // Produk
    Route::get('/products', [TokoController::class, 'products'])->name('products.index');

    // Keranjang
    Route::get('/cart', [TokoController::class, 'cart'])->name('cart.index');
    Route::post('/cart/add', [TokoController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/{id}', [TokoController::class, 'deleteCart'])->name('cart.delete');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // Invoice setelah checkout
    Route::get('/invoice/{id}', [CheckoutController::class, 'invoice'])->name('invoice.show');

    // Riwayat Pembayaran
    Route::get('/payments', [TokoController::class, 'payments'])->name('payments.index');

    // Halaman sukses pesanan (opsional)
    Route::get('/order-success/{id}', function ($id) {
        return view('toko.success', ['orderId' => $id]);
    })->name('order.success');
});
