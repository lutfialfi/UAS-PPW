@extends('toko.template')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-100 via-white to-indigo-100 py-12 px-6">
    <h1 class="text-4xl font-extrabold text-purple-700 mb-10 text-center tracking-wide drop-shadow-sm">
        🛍️ Katalog Produk Toko
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($products as $product)
        <div class="bg-white p-4 shadow rounded">
            <img src="{{ $product->image ? asset('image/' . $product->image) : asset('image/default.jpg') }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-40 object-cover rounded mb-3">
            <h2 class="text-lg font-bold">{{ $product->name }}</h2>
            <p>Kategori: {{ $product->category }}</p>
            <p>Harga: Rp{{ number_format($product->price) }}</p>
            <form method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="mt-2 px-3 py-1 bg-purple-600 text-white rounded">Tambah ke Keranjang</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection
