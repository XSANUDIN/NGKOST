@extends('layouts.user')

@section('user-content')
<div class="bg-white rounded-xl shadow-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Pengguna</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Status Pembayaran Terakhir</h3>
            <p class="text-xl font-bold text-blue-600">Lunas</p>
            <p class="text-gray-600 text-sm mt-2">Jatuh Tempo: 10 Maret 2024</p>
        </div>
        
        <div class="bg-green-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Status Laundry</h3>
            <p class="text-xl font-bold text-green-600">Dalam Proses</p>
            <p class="text-gray-600 text-sm mt-2">Estimasi Selesai: 15 Maret 2024</p>
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Riwayat Transaksi</h2>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Deskripsi</th>
                        <th class="px-6 py-3 text-left">Jumlah</th>
                        <th class="px-6 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @for($i = 1; $i <= 3; $i++)
                    <tr>
                        <td class="px-6 py-4">2024-03-0{{ $i }}</td>
                        <td class="px-6 py-4">Pembayaran Sewa Bulanan</td>
                        <td class="px-6 py-4">Rp 1.200.000</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                Lunas
                            </span>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection