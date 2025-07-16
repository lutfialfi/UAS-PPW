<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        // Redirect jika belum login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melanjutkan checkout.');
        }

        // Ambil item keranjang user
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung subtotal
        $subtotal = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        $shippingCost = 15000; // Biaya tetap
        $totalAmount = $subtotal + $shippingCost;

        return view('toko.checkout', compact('carts', 'subtotal', 'shippingCost', 'totalAmount'));
    }

    public function processCheckout(Request $request)
    {
        // Validasi input
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'payment_method' => 'required|in:bank_transfer,credit_card,cash_on_delivery',
        ]);

        $userId = Auth::id();
        $carts = Cart::where('user_id', $userId)->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);
        $shippingCost = 15000;
        $totalAmount = $subtotal + $shippingCost;

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => $userId,
                'total_amount' => $totalAmount,
                'shipping_address' => $request->address,
                'shipping_city' => $request->city,
                'shipping_postal_code' => $request->postal_code,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);

                // Jika ingin mengurangi stok produk:
                // $cart->product->decrement('stock', $cart->quantity);

                $cart->delete();
            }

            DB::commit();

            return redirect()->route('order.success', $order->id)->with('success', 'Pesanan Anda berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
