<?php





namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TokoController extends Controller
{
    public function products()
    {
        $products = Product::all();
        return view('toko.products', compact('products'));
    }

    public function addToCart(Request $request)
    {
        Cart::create([
            'product_id' => $request->product_id,
            'quantity' => 1
        ]);
        return redirect()->route('cart.index');
    }

    public function cart()
    {
        $carts = Cart::with('product')->get();
        return view('toko.cart', compact('carts'));
    }

    public function deleteCart($id)
    {
        Cart::destroy($id);
        return back();
    }

    public function checkout(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        $amount = $cart->product->price * $cart->quantity;

        Payment::create([
            'payment_id' => Str::uuid(),
            'cart_id' => $cart->id,
            'amount' => $amount,
            'payment_method' => 'Transfer Bank',
            'status' => 'Lunas',
            'paid_at' => now()
        ]);

        return redirect()->route('payments.index');
    }

    public function payments()
    {
        $payments = Payment::with('cart.product')->get();
        return view('toko.payments', compact('payments'));
    }
}
