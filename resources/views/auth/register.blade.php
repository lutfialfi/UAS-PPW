<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi - Toko Laravel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-purple-700 text-center">Registrasi</h2>

    @if($errors->any())
      <div class="text-red-600 text-sm mb-4 text-center">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="mb-4">
        <label class="block mb-1">Nama</label>
        <input type="text" name="name" class="w-full p-2 border rounded" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Email</label>
        <input type="email" name="email" class="w-full p-2 border rounded" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Password</label>
        <input type="password" name="password" class="w-full p-2 border rounded" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="w-full p-2 border rounded" required>
      </div>

      <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded">Daftar</button>
    </form>

    <p class="mt-4 text-sm text-center">
      Sudah punya akun? <a href="{{ route('login') }}" class="text-purple-600 hover:underline">Login di sini</a>
    </p>
  </div>

</body>
</html>
