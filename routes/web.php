<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController; // Pastikan ini ada di sini, di bagian paling atas!

// Redirect halaman utama ke halaman produk
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Login & Register (tidak memerlukan autentikasi)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout (memerlukan autentikasi, tapi rute POST ini bisa di luar group jika Anda mau,
// namun lebih aman di dalam group auth jika Anda ingin memastikan user terautentikasi saat logout)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- MULAI BLOK RUTE YANG MEMERLUKAN AUTENTIKASI ---
// Semua rute di dalam blok ini hanya bisa diakses oleh user yang sudah login
Route::middleware('auth')->group(function () {

    // Rute untuk Produk
    Route::get('/products', [TokoController::class, 'products'])->name('products.index');

    // Rute untuk Keranjang Belanja
    Route::post('/cart/add', [TokoController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [TokoController::class, 'cart'])->name('cart.index');
    Route::delete('/cart/{id}', [TokoController::class, 'deleteCart'])->name('cart.delete');

    // Rute untuk Checkout
    // Menggunakan CheckoutController yang baru untuk halaman checkout dan prosesnya
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

    // CATATAN: Rute POST '/checkout' yang lama dari TokoController
    // (Route::post('/checkout', [TokoController::class, 'checkout'])->name('checkout');)
    // telah dihapus/tidak disertakan di sini untuk menghindari konflik dan duplikasi.
    // Jika Anda memiliki logika checkout lama di TokoController yang masih ingin digunakan
    // untuk tujuan lain, harap berikan URI dan nama rute yang berbeda untuk itu.

    // Rute untuk Riwayat Pembayaran
    Route::get('/payments', [TokoController::class, 'payments'])->name('payments.index');

}); // --- AKHIR BLOK RUTE YANG MEMERLUKAN AUTENTIKASI ---