<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Toko Laravel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

  <div class="w-full max-w-md bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-purple-700 text-center">Login</h2>

    @if(session('success'))
      <p class="text-green-600 text-sm mb-4 text-center">{{ session('success') }}</p>
    @endif

    @if($errors->any())
      <div class="text-red-600 text-sm mb-4 text-center">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-4">
        <label class="block mb-1">Email</label>
        <input type="email" name="email" class="w-full p-2 border rounded" required>
      </div>
      <div class="mb-4">
        <label class="block mb-1">Password</label>
        <input type="password" name="password" class="w-full p-2 border rounded" required>
      </div>
      <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded">Login</button>
    </form>

    <p class="mt-4 text-sm text-center">
      Belum punya akun? <a href="{{ route('register') }}" class="text-purple-600 hover:underline">Daftar di sini</a>
    </p>
  </div>

</body>
</html>
