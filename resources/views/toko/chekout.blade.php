@extends('toko.template') {{-- Sesuaikan dengan layout Anda --}}

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-purple-100 py-12 px-6">
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-lg">
        <h1 class="text-3xl font-bold text-purple-700 mb-8 text-center">Checkout Pesanan</h1>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Kolom Kiri: Ringkasan Pesanan --}}
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Ringkasan Pesanan</h2>
                <div class="space-y-4">
                    @foreach ($carts as $cart)
                        <div class="flex items-center justify-between border-b pb-2">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('image/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="w-16 h-16 object-cover rounded shadow">
                                <div>
                                    <h3 class="font-medium text-gray-800">{{ $cart->product->name }}</h3>
                                    <p class="text-sm text-gray-600">Jumlah: {{ $cart->quantity }}</p>
                                </div>
                            </div>
                            <span class="font-semibold text-purple-700">Rp{{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 pt-4 border-t">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-700">Subtotal</span>
                        <span class="font-semibold text-gray-800">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-700">Biaya Pengiriman</span>
                        <span class="font-semibold text-gray-800">Rp{{ number_format($shippingCost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xl font-bold text-purple-800 pt-4 border-t-2 border-purple-200">
                        <span>Total Keseluruhan</span>
                        <span>Rp{{ number_format($totalAmount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Detail Pengiriman dan Pembayaran --}}
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Detail Pengiriman & Pembayaran</h2>
                <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Detail Pengiriman --}}
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea id="address" name="address" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500 @error('address') border-red-500 @enderror" required>{{ old('address', Auth::user()->address ?? '') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                            <input type="text" id="city" name="city" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500 @error('city') border-red-500 @enderror" value="{{ old('city', Auth::user()->city ?? '') }}" required>
                            @error('city')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                            <input type="text" id="postal_code" name="postal_code" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500 @error('postal_code') border-red-500 @enderror" value="{{ old('postal_code', Auth::user()->postal_code ?? '') }}" required>
                            @error('postal_code')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Metode Pembayaran --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                        <div class="mt-2 space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio text-purple-600" name="payment_method" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }} required>
                                <span class="ml-2 text-gray-800">Transfer Bank</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" class="form-radio text-purple-600" name="payment_method" value="credit_card" {{ old('payment_method') == 'credit_card' ? 'checked' : '' }} required>
                                <span class="ml-2 text-gray-800">Kartu Kredit</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" class="form-radio text-purple-600" name="payment_method" value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'checked' : '' }} required>
                                <span class="ml-2 text-gray-800">COD (Bayar di Tempat)</span>
                            </label>
                        </div>
                        @error('payment_method')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-purple-600 text-white py-3 px-4 rounded-md shadow-md hover:bg-purple-700 transition duration-300 font-semibold text-lg">
                        Lanjutkan Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection