<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Toko Laravel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

  <nav class="bg-white shadow p-4 mb-6">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <h1 class="text-xl font-bold text-purple-700">TOKO ONLINE</h1>
      <div class="space-x-4">
        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-purple-600">Produk</a>
        <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-purple-600">Keranjang</a>
        <a href="{{ route('payments.index') }}" class="text-gray-600 hover:text-purple-600">Pembayaran</a>
      </div>
    </div>
  </nav>

  <div class="max-w-7xl mx-auto p-6">
    @yield('content')
  </div>
@auth
  <form method="POST" action="{{ route('logout') }}" class="inline">@csrf
    <button class="text-red-500 hover:underline">Logout</button>
  </form>
@endauth

</body>
</html>
