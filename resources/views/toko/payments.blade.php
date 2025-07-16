@extends('toko.template')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-purple-100 py-12 px-6">

  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-purple-700 mb-6 flex items-center gap-2">
      💳 Riwayat Pembayaran
    </h1>

    @if($payments->isEmpty())
      <div class="text-center text-gray-500 text-lg bg-white p-6 rounded shadow">
        Belum ada pembayaran 😔
      </div>
    @else
      <div class="bg-white rounded-xl shadow-lg p-4 flex flex-col relative">
        <div class="overflow-x-auto">
          <table class="w-full text-sm border rounded">
            <thead class="bg-indigo-100 text-indigo-700 font-semibold">
              <tr>
                <th class="p-3">ID</th>
                <th>Produk</th>
                <th>Metode</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              @foreach($payments as $payment)
              <tr class="border-t hover:bg-gray-50 transition">
                <td class="p-3 font-semibold text-gray-700">{{ $payment->payment_id }}</td>
                <td class="flex items-center gap-3 p-3">
                  <img src="{{ asset('image/' . $payment->cart->product->image) }}" alt="{{ $payment->cart->product->name }}"
                       class="w-12 h-12 object-cover rounded shadow">
                  <span>{{ $payment->cart->product->name }}</span>
                </td>
                <td class="p-3">{{ $payment->payment_method }}</td>
                <td class="p-3 text-purple-700 font-bold">Rp{{ number_format($payment->amount) }}</td>
                <td class="p-3">
                  <span class="{{ $payment->status == 'Lunas' ? 'text-green-600' : 'text-red-500' }} font-semibold">
                    {{ $payment->status }}
                  </span>
                </td>
                <td class="p-3">{{ $payment->paid_at }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Tombol Logout di dalam kotak, pojok kiri bawah -->
        <div class="mt-6">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-5 py-2 rounded-full shadow hover:from-red-600 hover:to-pink-600 transition font-semibold text-sm">
              🔒 Logout
            </button>
          </form>
        </div>
      </div>
    @endif
  </div>

</div>
@endsection
