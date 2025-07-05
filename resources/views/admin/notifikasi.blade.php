@extends('layouts.layouts')

@section('admin')
<div class="flex flex-col md:flex-row gap-6 mt-6">
    {{-- Sidebar --}}
    <div class="w-full md:w-64">
        @include('admin.components.sidebar')
    </div>

    {{-- Form Notifikasi --}}
    <div class="flex-1 bg-white dark:bg-gray-900 rounded-lg shadow p-6">
        <div class="max-w-xl mx-auto space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">🔔 Pengingat Update Kamar</h2>

            <form action="{{ route('notifikasi.update') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan</label>
                    <input type="text" name="catatan" value="{{ old('catatan', $notif->catatan ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Mulai</label>
                    <input type="date" name="jadwal" value="{{ old('jadwal', $notif->jadwal ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Frekuensi</label>
                    <select name="frekuensi"
                        class="w-full px-4 py-2 border rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="mingguan" {{ old('frekuensi', $notif->frekuensi ?? '') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                        <option value="bulanan" {{ old('frekuensi', $notif->frekuensi ?? '') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    </select>
                </div>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition">
                    Simpan Pengingat
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
