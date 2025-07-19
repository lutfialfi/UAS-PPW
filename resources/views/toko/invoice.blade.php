@extends('toko.template')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white shadow-md p-8 rounded">
    <h1 class="text-3xl font-bold text-purple-700 mb-6">Invoice #{{ $order->id }}</h1>

    <p class="text-gray-700 mb-2"><strong>Alamat:</strong> {{ $order->shipping_address }}, {{ $order->shipping_city }} - {{ $order->shipping_postal_code }}</p>
    <p class="text-gray-700 mb-2"><strong>Metode Pembayaran:</strong> {{ ucfirst($order->payment_method) }}</p>
    <p class="text-gray-700 mb-6"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-purple-100 text-purple-700">
                <th class="p-2 border">Produk</th>
                <th class="p-2 border">Jumlah</th>
                <th class="p-2 border">Harga</th>
                <th class="p-2 border">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr class="text-gray-700">
                    <td class="p-2 border">{{ $item->product->name }}</td>
                    <td class="p-2 border">{{ $item->quantity }}</td>
                    <td class="p-2 border">Rp{{ number_format($item->price) }}</td>
                    <td class="p-2 border">Rp{{ number_format($item->price * $item->quantity) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right mt-6 text-xl font-semibold text-purple-700">
        Total: Rp{{ number_format($order->total_amount) }}
    </div>
</div>
@endsection
