@extends('layouts.layouts')

@section('admin')
<div class="flex flex-col md:flex-row gap-6 mt-6">
    {{-- Sidebar --}}
    <div class="w-full md:w-64">
        @include('admin.components.sidebar')
    </div>

    {{-- Main Content --}}
    <div class="flex-1 bg-white dark:bg-gray-900 rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">📊 Laporan Transaksi</h2>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <form method="GET" class="mb-4 flex flex-wrap items-center gap-4">
                <label class="text-sm text-gray-600 dark:text-gray-300">
                    Bulan:
                    <input type="month" name="bulan" class="ml-2 px-2 py-1 border rounded dark:bg-gray-800 dark:text-white" value="{{ request('bulan') }}">
                </label>
                <button type="submit" class="px-4 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Terapkan</button>
            </form>

            <table class="min-w-full text-sm text-left border border-gray-200 dark:border-gray-700 rounded-lg">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Nama Penghuni</th>
                        <th class="p-4">Layanan</th>
                        <th class="p-4">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                    @forelse ($transaksi as $trx)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        <td class="p-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d M Y') }}
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                {{ $trx->tipe == 'sewa' 
                                    ? 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300' 
                                    : 'bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-300' }}">
                                {{ ucfirst($trx->tipe) }}
                            </span>
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            {{ $trx->user->nama }}
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            {{ $trx->laundry?->jenis_layanan ?? '-' }}
                        </td>
                        <td class="p-4 whitespace-nowrap font-semibold text-gray-800 dark:text-white">
                            Rp {{ number_format($trx->total, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 dark:text-gray-400 p-4">Belum ada transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
