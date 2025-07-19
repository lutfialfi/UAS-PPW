<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
{
    public function products()
    {
        $products = Product::all();
        return view('toko.products', compact('products'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        Cart::create([
            'user_id' => Auth::id(), // <- Fix di sini
            'product_id' => $request->product_id,
            'quantity' => 1
        ]);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function cart()
    {
        $carts = Cart::with('product')
                    ->where('user_id', Auth::id()) // <- hanya tampilkan keranjang user sendiri
                    ->get();

        return view('toko.cart', compact('carts'));
    }

    public function deleteCart($id)
    {
        $cart = Cart::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->first();

        if ($cart) {
            $cart->delete();
        }

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $cart = Cart::where('id', $request->cart_id)
                    ->where('user_id', Auth::id())
                    ->first();

        if (!$cart) {
            return back()->with('error', 'Keranjang tidak ditemukan.');
        }

        $amount = $cart->product->price * $cart->quantity;

        Payment::create([
            'payment_id' => Str::uuid(),
            'cart_id' => $cart->id,
            'amount' => $amount,
            'payment_method' => 'Transfer Bank',
            'status' => 'Lunas',
            'paid_at' => now()
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil.');
    }

    public function payments()
    {
        $payments = Payment::with('cart.product')
                        ->whereHas('cart', function ($query) {
                            $query->where('user_id', Auth::id());
                        })
                        ->get();

        return view('toko.payments', compact('payments'));
    }
}
