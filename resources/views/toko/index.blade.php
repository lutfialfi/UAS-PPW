@extends('toko.template')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-100 via-white to-indigo-100 py-12 px-6">
    <h1 class="text-4xl font-extrabold text-purple-700 mb-10 text-center tracking-wide drop-shadow-sm">
        🛍️ Katalog Produk Toko
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($products as $product)
            <div class="bg-white p-4 shadow-md rounded-xl transition-transform hover:scale-105">
                <img 
                    src="{{ asset('image/' . ($product->image ?? 'default.jpg')) }}" 
                    alt="{{ $product->name }}" 
                    class="w-full h-40 object-cover rounded mb-3"
                    onerror="this.onerror=null; this.src='{{ asset('image/default.jpg') }}';">
                
                <h2 class="text-lg font-bold text-gray-800">{{ $product->name }}</h2>
                <p class="text-sm text-gray-600">Kategori: {{ $product->category }}</p>
                <p class="text-purple-700 font-semibold mb-2">Harga: Rp{{ number_format($product->price, 0, ',', '.') }}</p>

                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button 
                        type="submit"
                        class="w-full px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition font-medium">
                        Tambah ke Keranjang
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
