@extends('toko.template')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-100 via-white to-indigo-100 py-12 px-6">
    <h1 class="text-4xl font-extrabold text-purple-700 mb-10 text-center tracking-wide drop-shadow-sm">
        🛍️ Katalog Produk Toko
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($products as $product)
        <div class="bg-white p-5 rounded-2xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex flex-col">
            <img src="{{ asset('image/' . $product->image) }}" alt="{{ $product->name }}"
                class="w-full h-44 object-cover rounded-xl shadow mb-4">
            <div class="flex-grow">
                <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                <p class="text-sm text-gray-500">{{ $product->category }}</p>
                <p class="mt-2 text-gray-600 text-sm line-clamp-2">{{ $product->description }}</p>
            </div>
            
            {{-- Bagian tambahan untuk menampilkan stok --}}
            <p class="mt-2 text-sm text-gray-500">
                Stok Tersedia: <span class="font-bold text-gray-700">{{ $product->stock }}</span>
            </p>
            
            <p class="mt-4 text-lg font-bold text-purple-700">Rp{{ number_format($product->price) }}</p>
            
            <form method="POST" action="{{ route('cart.add') }}" class="mt-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="w-full bg-gradient-to-r from-purple-500 to-indigo-500 text-white py-2 rounded-xl font-semibold shadow hover:from-purple-600 hover:to-indigo-600 transition">
                    Tambah ke Keranjang
                </button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection