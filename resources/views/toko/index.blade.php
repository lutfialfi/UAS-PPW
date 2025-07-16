<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Toko Modern Laravel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: linear-gradient(to right, #fdfbfb, #ebedee);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .pattern-bg {
      background-image: radial-gradient(circle at 1px 1px, #e2e8f0 1px, transparent 0);
      background-size: 20px 20px;
    }
  </style>
</head>
<body class="text-gray-800 pattern-bg">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-4xl font-extrabold text-purple-700 mb-10 text-center tracking-wide drop-shadow-sm">🛍️ Katalog Produk</h1>

    <!-- PRODUK -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 mb-16">
      @foreach($products as $product)
      <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-4 flex flex-col">
        <img src="{{ asset('image/' . $product->image) }}" alt="{{ $product->name }}"
             class="w-full h-40 object-cover rounded-lg shadow-sm mb-4">
        <div class="flex-grow">
          <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
          <p class="text-sm text-gray-500">{{ $product->category }}</p>
          <p class="mt-2 text-gray-600 text-sm">{{ $product->description }}</p>
        </div>
        <p class="mt-3 font-bold text-purple-700 text-lg">Rp{{ number_format($product->price) }}</p>
        <form method="POST" action="{{ route('cart.add') }}" class="mt-4">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-xl font-semibold shadow-md">
            Tambah ke Keranjang
          </button>
        </form>
      </div>
      @endforeach
    </div>

    <!-- KERANJANG -->
    <h2 class="text-3xl font-bold text-purple-700 mb-4">🛒 Keranjang Anda</h2>
    <div class="overflow-x-auto mb-12 bg-white rounded-lg shadow">
      <table class="w-full text-sm text-left">
        <thead class="bg-purple-100 text-purple-700 font-semibold">
          <tr>
            <th class="p-4">Produk</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($carts as $cart)
          <tr class="border-t">
            <td class="p-4 flex items-center gap-4">
              <img src="{{ asset('image/' . $cart->product->image) }}" alt="{{ $cart->product->name }}"
                   class="w-14 h-14 object-cover rounded">
              <span class="text-gray-800">{{ $cart->product->name }}</span>
            </td>
            <td>{{ $cart->quantity }}</td>
            <td>Rp{{ number_format($cart->product->price * $cart->quantity) }}</td>
            <td class="space-x-2">
              <form method="POST" action="{{ route('cart.delete', $cart->id) }}" class="inline">
                @csrf @method('DELETE')
                <button class="text-red-500 hover:underline">Hapus</button>
              </form>
              <form method="POST" action="{{ route('checkout') }}" class="inline">
                @csrf
                <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                <button class="text-green-600 hover:underline">Checkout</button>
              </form>
            </td>
          </tr>
          @empty
          <tr><td colspan="4" class="p-4 text-center text-gray-500">Keranjang masih kosong</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- PEMBAYARAN -->
    <h2 class="text-3xl font-bold text-purple-700 mb-4">💳 Riwayat Pembayaran</h2>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="w-full text-sm">
        <thead class="bg-indigo-100 text-indigo-700 font-semibold">
          <tr>
            <th class="p-4">ID</th>
            <th>Metode</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          @forelse($payments as $payment)
          <tr class="border-t">
            <td class="p-4">{{ $payment->payment_id }}</td>
            <td>{{ $payment->payment_method }}</td>
            <td>Rp{{ number_format($payment->amount) }}</td>
            <td class="text-green-600 font-bold">{{ $payment->status }}</td>
            <td>{{ $payment->paid_at }}</td>
          </tr>
          @empty
          <tr><td colspan="5" class="p-4 text-center text-gray-500">Belum ada pembayaran</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Logout Button Fixed Position -->
  <form method="POST" action="{{ route('logout') }}" class="fixed bottom-5 left-5 z-50">
    @csrf
    <button class="bg-white border border-gray-300 text-red-600 px-4 py-2 rounded-full shadow hover:bg-red-50 hover:text-red-700 transition">
      Logout
    </button>
  </form>

</body>
</html>
