@extends('layouts.layouts')

@section('content')

<div class="max-w-5xl mx-auto">
  <h2 class="text-2xl font-bold mb-6">Riwayat Transaksi Saya</h2>

  {{-- Filter --}}
  <form method="GET" class="mb-6 flex flex-wrap items-center gap-2">
    <label for="bulan" class="text-sm text-gray-700 dark:text-gray-300">Pilih Bulan:</label>
    <select name="bulan" id="bulan" onchange="this.form.submit()" class="border rounded px-3 py-2 text-sm dark:bg-gray-800 dark:text-white">
      @foreach($bulanList as $num => $nama)
        <option value="{{ $num }}" {{ (int)$bulan == (int)$num ? 'selected' : '' }}>{{ $nama }}</option>
      @endforeach
    </select>
  </form>

  {{-- TABEL DESKTOP --}}
  <div class="hidden md:block">
    @if ($transaksi->count())
      <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm table-auto">
          <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
            <tr>
              <th class="p-3">Tanggal</th>
              <th class="p-3">Kategori</th>
              <th class="p-3">Keterangan</th>
              <th class="p-3 text-right">Jumlah</th>
              <th class="p-3">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
            @foreach ($transaksi as $transaction)
              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                <td class="p-3 dark:text-white">{{ \Carbon\Carbon::parse($transaction->tanggal_transaksi)->format('d-m-Y') }}</td>
                <td class="p-3">
                  <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold 
                    {{ $transaction->tipe === 'sewa' ? 'bg-green-100 text-green-700 dark:bg-green-700 dark:green-400' : 'bg-teal-100 text-teal-700 dark:bg-teal-700 dark:text-teal-800' }}">
                    {{ ucfirst($transaction->tipe) }}
                  </span>
                </td>
                <td class="p-3 text-sm text-gray-700 dark:text-gray-300">
                  {{ $transaction->keterangan ?? '-' }}
                </td>
                <td class="p-3 text-right font-medium text-gray-900 dark:text-white">
                  Rp {{ number_format($transaction->total, 0, ',', '.') }}
                </td>
                <td class="p-3 text-center">
                  @if ($transaction->status !== 'lunas')
                    <form action="{{ route('user.bayar', $transaction->id) }}" method="POST">
                      @csrf
                      <button type="submit"
                              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded text-sm transition">
                        Bayar
                      </button>
                    </form>
                  @else
                    <span class="text-green-600 dark:text-green-400 font-semibold">✔ Lunas</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="mt-6 text-sm text-right text-gray-600 dark:text-gray-400">
            Total Transaksi: <span class="font-semibold">{{ $transaksi->count() }}</span> |
            Total Belum Bayar:
            <span class="font-semibold text-red-500">
            {{ $transaksi->where('status', 'belum')->count() }}
            </span>
        </div>
      </div>
    @else
      <div class="text-center text-gray-500 dark:text-gray-400 mt-10">
        <p>Belum ada transaksi untuk bulan ini.</p>
      </div>
    @endif
  </div>

  {{-- CARD MOBILE --}}
  <div class="md:hidden space-y-4 overflow-y-auto pr-2" style="max-height: 70vh;">
  @forelse ($transaksi as $t)
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm w-full">
      <div class="flex justify-between items-center">
        <div>
          <p class="text-sm font-medium text-gray-800 dark:text-white break-words">
            {{ ucfirst($t->tipe) }} - Rp {{ number_format($t->total, 0, ',', '.') }}
          </p>
          <p class="text-xs text-gray-500 dark:text-gray-400">
            {{ \Carbon\Carbon::parse($t->tanggal_transaksi)->translatedFormat('d M Y') }}
          </p>
        </div>
        <div>
          @if ($t->status === 'lunas')
            <span class="text-green-600 dark:text-green-400 text-sm font-semibold">✔ Lunas</span>
          @else
            <form action="{{ route('user.bayar', $t->id) }}" method="POST">
              @csrf
              <button type="submit"
                      class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded transition">
                Bayar
              </button>
            </form>
          @endif
        </div>
      </div>
    </div>
  @empty
    <div class="text-center text-gray-500 dark:text-gray-400 mt-10">
      <p>Tidak ada transaksi untuk bulan ini.</p>
    </div>
  @endforelse
</div>

@endsection
