<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return view('toko.invoice', compact('order'));
    }
}
