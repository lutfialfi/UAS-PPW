@extends('toko.template')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-purple-100 py-12 px-6">
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-purple-700 mb-6 flex items-center gap-2">
            🛒 Keranjang
        </h1>

        @if($carts->isEmpty())
            <div class="text-center text-gray-500 text-lg bg-white p-6 rounded shadow">
                Keranjang kamu masih kosong 😔
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-4 flex flex-col relative">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border rounded">
                        <thead class="bg-purple-100 text-purple-700 font-semibold">
                            <tr>
                                <th class="p-4">Produk</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @php $grandTotal = 0; @endphp
                            @foreach($carts as $cart)
                                @php
                                    $subtotal = $cart->product->price * $cart->quantity;
                                    $grandTotal += $subtotal;
                                @endphp
                                <tr class="border-t hover:bg-gray-50 transition">
                                    <td class="p-4 flex items-center gap-4">
                                        <img src="{{ asset('image/' . $cart->product->image) }}" alt="{{ $cart->product->name }}"
                                            class="w-16 h-16 object-cover rounded shadow border">
                                        <span class="font-medium text-gray-700">{{ $cart->product->name }}</span>
                                    </td>
                                    <td class="text-center">{{ $cart->quantity }}</td>
                                    <td class="text-purple-700 font-bold">Rp{{ number_format($subtotal) }}</td>
                                    <td class="p-3 space-x-2">
                                        <form method="POST" action="{{ route('cart.delete', $cart->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Total Keseluruhan -->
                <div class="mt-6 text-right text-lg font-semibold text-purple-700">
                    Total Belanja: Rp{{ number_format($grandTotal) }}
                </div>

                <!-- Tombol Lanjutkan ke Checkout -->
                <div class="mt-8 text-right">
                    <form action="{{ route('checkout.index') }}" method="GET">
                        <button type="submit" class="bg-purple-600 text-white px-6 py-3 rounded-full shadow-md hover:bg-purple-700 transition duration-300 font-semibold text-lg">
                            Lanjutkan ke Checkout
                        </button>
                    </form>
                </div>

                <!-- Tombol Logout -->
                <div class="mt-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-5 py-2 rounded-full shadow hover:from-red-600 hover:to-pink-600 transition font-semibold text-sm">
                            🔒 Logout
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
