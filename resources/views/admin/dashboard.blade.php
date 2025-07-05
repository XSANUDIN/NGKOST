@extends('layouts.layouts')

@section('admin')
<div class="flex flex-col md:flex-row gap-6 mt-6">
    {{-- Sidebar --}}
    <div class="w-full md:w-64">
        @include('admin.components.sidebar')
    </div>

    {{-- Dashboard Content --}}
    <div class="flex-1 bg-white dark:bg-gray-900 rounded-xl shadow p-6">
        <h1 class="text-3xl font-bold mb-8 text-gray-800 dark:text-white">Dashboard Admin</h1>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">
            {{-- Pendapatan Sewa --}}
            <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg shadow hover:shadow-md transition">
                <h3 class="text-sm font-semibold text-blue-700 dark:text-blue-900 mb-2">Pendapatan Sewa</h3>
                <p class="text-2xl font-bold text-blue-800 dark:text-blue-800">
                    Rp {{ number_format($pendapatanSewa ?? 0, 0, ',', '.') }}
                </p>
            </div>

            {{-- Pendapatan Laundry --}}
            <div class="bg-green-50 dark:bg-green-900/20 p-6 rounded-lg shadow hover:shadow-md transition">
                <h3 class="text-sm font-semibold text-green-700 dark:text-green-900 mb-2">Pendapatan Laundry</h3>
                <p class="text-2xl font-bold text-green-800 dark:text-green-800">
                    Rp {{ number_format($pendapatanLaundry ?? 0, 0, ',', '.') }}
                </p>
            </div>

            {{-- Jumlah Penghuni --}}
            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-6 rounded-lg shadow hover:shadow-md transition">
                <h3 class="text-sm font-semibold text-yellow-700 dark:text-yellow-900 mb-2">Jumlah Penghuni</h3>
                <p class="text-2xl font-bold text-yellow-800 dark:text-yellow-800">
                    {{ $jumlahPenghuni ?? 0 }}
                </p>
            </div>
        </div>

        {{-- Aktivitas Terbaru --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-700 dark:text-white">Riwayat Pembayaran Terbaru</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border border-gray-200 dark:border-gray-600 rounded-lg">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="p-4">Tanggal</th>
                                <th class="p-4">Nama Penghuni</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600 text-gray-700 dark:text-white">
                            @forelse ($aktivitasTerbaru as $trx)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="p-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d M Y') }}
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        {{ $trx->user->nama ?? '-' }}
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                                            {{ $trx->tipe === 'sewa' ? 'bg-blue-100 text-blue-600 dark:bg-blue-800 dark:text-blue-400' : 'bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-400' }}">
                                            {{ ucfirst($trx->tipe) }}
                                        </span>
                                    </td>
                                    <td class="p-4 whitespace-nowrap font-semibold text-gray-800 dark:text-gray-100">
                                        Rp {{ number_format($trx->total ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-4 text-gray-500 dark:text-gray-400">
                                        Belum ada aktivitas terbaru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
