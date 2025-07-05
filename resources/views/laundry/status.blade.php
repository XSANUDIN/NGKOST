@extends('layouts.layouts')

@section('content')

<div class="max-w-4xl mx-auto mt-6 px-4">
    <section class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4"> Status Laundry Saya</h2>
        <div class="flex justify-center">
            @include('laundry.track', ['status' => $latestStatus])
        </div>
    </section>

    {{-- DESKTOP TABLE --}}
    <section class="hidden md:block bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md overflow-x-auto">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">🧾 History Laundry</h3>
        <table class="w-full text-sm table-auto">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <tr>
                    <th class="p-2 text-left">Tanggal</th>
                    <th class="p-2 text-left">Catatan</th>
                    <th class="p-2 text-left">Layanan</th>
                    <th class="p-2 text-left">Berat</th>
                    <th class="p-2 text-left">Biaya</th>
                    <th class="p-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                @forelse ($laundries as $laundry)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 text-gray-900 dark:text-white">
                    <td class="p-2">{{ \Carbon\Carbon::parse($laundry->tanggal)->format('d-m-Y') }}</td>
                    <td class="p-2">{{ $laundry->catatan }}</td>
                    <td class="p-2">{{ $laundry->jenis_layanan }}</td>
                    <td class="p-2">{{ $laundry->berat ? number_format($laundry->berat, 1) . ' kg' : '-' }}</td>
                    <td class="p-2">{{ $laundry->harga ? 'Rp ' . number_format($laundry->harga, 0, ',', '.') : '-' }}</td>
                    <td class="p-2 font-semibold">
                        @switch($laundry->status)
                            @case('selesai')
                                <span class="text-green-600 dark:text-green-400">✅ Selesai</span>
                                @break
                            @case('dicuci')
                                <span class="text-yellow-500 dark:text-yellow-400">🧺 Diproses</span>
                                @break
                            @default
                                <span class="text-gray-500 dark:text-gray-300">🕒 Menunggu</span>
                        @endswitch
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500 dark:text-gray-400">Belum ada data laundry.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    {{-- MOBILE CARD VIEW --}}
    <section class="md:hidden space-y-4 mt-4 max-h-[500px] overflow-y-auto pr-1">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">🧾 History Laundry</h3>
        @forelse ($laundries as $laundry)
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ \Carbon\Carbon::parse($laundry->tanggal)->format('d M Y') }}
                    </p>
                    <h4 class="text-base font-semibold text-gray-800 dark:text-white">
                        {{ $laundry->jenis_layanan }}
                    </h4>
                </div>
                <div class="text-sm font-medium">
                    @switch($laundry->status)
                        @case('selesai')
                            <span class="text-green-600 dark:text-green-400">✅</span>
                            @break
                        @case('dicuci')
                            <span class="text-yellow-500 dark:text-yellow-400">🧺</span>
                            @break
                        @default
                            <span class="text-gray-500 dark:text-gray-300">🕒</span>
                    @endswitch
                </div>
            </div>
            <div class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                <p>Catatan: {{ $laundry->catatan }}</p>
                <p>Berat: {{ $laundry->berat ?? '-' }} kg</p>
                <p>Biaya: {{ $laundry->harga ? 'Rp ' . number_format($laundry->harga, 0, ',', '.') : '-' }}</p>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 dark:text-gray-400 mt-4">Belum ada data laundry.</p>
        @endforelse
    </section>
</div>
@endsection
