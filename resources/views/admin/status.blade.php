@extends('layouts.layouts')

@section('admin')
<div class="flex flex-col md:flex-row gap-6 mt-6">
    {{-- Sidebar --}}
    <div class="w-full md:w-64">
        @include('admin.components.sidebar')
    </div>

    {{-- Main Content --}}
    <div class="flex-1">

        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Daftar Laundry Penghuni</h2>
        <div class="flex justify-end mb-4">
            <button id="toggleSelesai" class="px-5 py-2.5 dark:bg-gray-100 hover:bg-gray-200 text-sm text-gray-800 rounded-md shadow-sm hover:shadow-md transition-all duration-200 ease-in-out">
                Tampilkan Laundry Selesai
            </button>
        </div>


        <div class="bg-white dark:bg-gray-900 shadow-md rounded-xl overflow-x-auto p-4">
            <table class="w-full text-sm min-w-max">
                <thead class="bg-gray-200 dark:bg-gray-800 text-left text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="p-3">Penghuni</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Layanan</th>
                        <th class="p-3">Catatan</th>
                        <th class="p-3">Berat</th>
                        <th class="p-3">Biaya</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                    @foreach ($laundries as $laundry)
                    <tr class="border-b {{ $laundry->status === 'selesai' ? 'hidden selesai-row' : '' }}">
                        <form action="{{ route('status.edit', $laundry->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td class="p-3">{{ $laundry->user->nama }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($laundry->tanggal)->format('d-m-Y') }}</td>
                            <td class="p-3">{{ $laundry->jenis_layanan }}</td>
                            <td class="p-3">{{ $laundry->catatan }}</td>
                            <td class="p-3">
                                <input type="number" name="berat" class="border px-2 py-1 w-20 text-sm text-gray-900" value="{{ $laundry->berat }}">
                            </td>
                            <td class="p-3">
                                <input type="number" name="harga" class="border px-2 py-1 w-24 text-sm text-gray-900" value="{{ $laundry->harga }}">
                            </td>
                            <td class="p-3">
                                <select name="status" class="border rounded px-2 py-1 text-sm text-gray-900">
                                    <option value="masuk" {{ $laundry->status === 'masuk' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="dicuci" {{ $laundry->status === 'dicuci' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $laundry->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </td>
                            <td class="p-3">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Update</button>
                                <a href="{{ route('status.destroy', $laundry->id) }}" class="ml-2 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                    Hapus
                                </a>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const toggleBtn = document.getElementById('toggleSelesai');
    const selesaiRows = document.querySelectorAll('.selesai-row');
    let isShown = false;

    toggleBtn.addEventListener('click', () => {
        selesaiRows.forEach(row => {
            row.classList.toggle('hidden');
        });
        isShown = !isShown;
        toggleBtn.textContent = isShown ? 'Sembunyikan Laundry Selesai' : 'Tampilkan Laundry Selesai';
    });
</script>


@endsection
