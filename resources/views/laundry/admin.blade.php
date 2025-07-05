@extends('layouts.layouts')

@section('content')
<div class="max-w-6xl mx-auto">
<h2 class="text-2xl font-bold mb-6">📋 Daftar Laundry Penghuni</h2>

<div class="bg-white shadow-md rounded-xl overflow-x-auto p-4">
    <table class="w-full text-sm">
    <thead class="bg-gray-200 text-left">
        <tr>
        <th class="p-3">Nama Penghuni</th>
        <th class="p-3">Tanggal</th>
        <th class="p-3">Jumlah</th>
        <th class="p-3">Layanan</th>
        <th class="p-3">Status</th>
        <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($laundries as $laundry) --}}
        <tr class="border-b">
        <td class="p-3">username</td>
        <td class="p-3">20-10-2020</td>
        <td class="p-3">10 pcs</td>
        <td class="p-3">laundry kilat</td>
        <td class="p-3 font-medium">
            <span class="text-green-600">Selesai</span>
            <span class="text-yellow-600">Diproses</span>
            <span class="text-gray-500">Menunggu</span>
        </td>
        <td class="p-3">
            <form action="" method="POST">
            @csrf
            @method('PUT')
            <select name="status" class="border rounded px-2 py-1 text-sm">
                <option value="menunggu" >Menunggu</option>
                <option value="diproses" >Diproses</option>
                <option value="selesai" >Selesai</option>
            </select>
            <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                Update
            </button>
            </form>
        </td>
        </tr>
        {{-- @endforeach --}}
    </tbody>
    </table>
</div>
</div>
@endsection