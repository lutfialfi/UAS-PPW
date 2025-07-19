@extends('toko.template')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold text-purple-700 mb-6">Form Checkout</h1>

    <form method="POST" action="{{ route('checkout.process') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Alamat Pengiriman</label>
            <textarea name="shipping_address" class="w-full border rounded p-2" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Kota</label>
            <input type="text" name="shipping_city" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Kode Pos</label>
            <input type="text" name="shipping_postal_code" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Metode Pembayaran</label>
            <select name="payment_method" class="w-full border rounded p-2" required>
                <option value="">-- Pilih --</option>
                <option value="transfer">Transfer Bank</option>
                <option value="cod">Bayar di Tempat (COD)</option>
            </select>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700">
                Proses Pesanan
            </button>
        </div>
    </form>
</div>
@endsection
