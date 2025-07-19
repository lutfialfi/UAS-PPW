@extends('toko.template')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-purple-100 py-12 px-6">
    <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-purple-700 mb-6">🛒 Checkout</h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium">Alamat Pengiriman</label>
                <input type="text" name="shipping_address" class="w-full p-2 border rounded" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Kota</label>
                    <input type="text" name="shipping_city" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Kode Pos</label>
                    <input type="text" name="shipping_postal_code" class="w-full p-2 border rounded" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Metode Pembayaran</label>
                <select name="payment_method" class="w-full p-2 border rounded" required>
                    <option value="cod">Bayar di Tempat (COD)</option>
                    <option value="bank_transfer">Transfer Bank</option>
                    <option value="credit_card">Kartu Kredit</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold shadow">
                    Lanjutkan & Buat Pesanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
