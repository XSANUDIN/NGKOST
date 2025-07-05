@extends('layouts.layouts')

@section('content')

<div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md mt-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
        Form Titip Laundry
    </h2>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('laundry.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Tanggal --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Tanggal Titip</label>
            <input type="date" name="tanggal" value="{{ now()->format('Y-m-d') }}"
                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                   required>
        </div>

        {{-- Layanan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Jenis Layanan</label>
            <select name="jenis_layanan"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                    required>
                <option value="" disabled selected>-- Pilih Layanan --</option>
                <option value="Cuci Kering">Cuci Kilat</option>
                <option value="Cuci Setrika">Cuci Setrika</option>
                <option value="Setrika Saja">Setrika Pakaian</option>
                <option value="Cuci Saja">Cuci Pakaian</option>
            </select>
        </div>

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Catatan</label>
            <input type="text" name="catatan"
                   placeholder="Contoh: Baju putih pisahkan"
                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                   required>
        </div>

        {{-- Tombol --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg transition">
                Titip Sekarang
            </button>

            <a href="{{ route('laundry.status') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white text-center font-medium py-2 px-6 rounded-lg transition">
                Cek Status
            </a>
        </div>
    </form>
</div>

@endsection
