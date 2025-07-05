<?php

namespace App\Http\Controllers;
use App\Services\WhatsappService;

use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController
{
    /**
     * Display a listing of the resource.
     */
    public function laporan(Request $request)
    {
        $query = Transaksi::with('user', 'laundry') // tambahkan 'laundry' jika perlu
            ->latest('tanggal_transaksi');

        if ($request->bulan) {
            $tanggal = Carbon::parse($request->bulan);
            $query->whereMonth('tanggal_transaksi', $tanggal->month)
                ->whereYear('tanggal_transaksi', $tanggal->year);
        }

        $transaksi = $query->get();

        return view('admin.laporan', compact('transaksi'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the current authenticated user ID
        $userId = Auth::id();
        $bulan = $request->get('bulan') ?? now()->format('m');


        $transaksi = Transaksi::whereMonth('tanggal_transaksi', $bulan)
            // ->where('user_id', auth()->id())
            ->where('user_id', $userId)
            ->orderByDesc('tanggal_transaksi')
            ->get();
            
            $bulanList = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        // Pass the collection of transactions to the view
        return view('user.transaksi', compact('transaksi', 'bulanList', 'bulan'));
    }

    /**
     * Display a listing of the resource.
     */
    // public function bayar($id)
    // {
    //     // Temukan transaksi
    //     $transaction = Transaksi::findOrFail($id);

    //     // Update status menjadi lunas
    //     $transaction->status = 'lunas';
    //     $transaction->save();

    //     // Kirim pesan WhatsApp
    //     $wa = new WhatsappService();

    //     $user = $transaction->user; // pastikan relasi user() ada di model Transaksi
    //     $nomor = $user->no_hp; // pastikan kolom no_hp tersedia
    //     $pesan = "*Pembayaran Berhasil*\n\nHalo {$user->nama},\nTransaksi untuk pembayaran {$transaction->tipe} sebesar Rp " . number_format($transaction->total, 0, ',', '.') . " telah *dibayar*.\n\nTerima kasih!";

    //     $response = $wa->sendMessage($nomor, $pesan);

    //     if ($response->successful()) {
    //         return redirect()->back()->with('success', 'Pembayaran berhasil & notifikasi terkirim via WhatsApp!');
    //     } else {
    //         return redirect()->back()->with('error', 'Pembayaran berhasil, tapi gagal kirim WA: ' . $response->body());
    //     }
    //     return redirect()->back()->with('success', 'Pembayaran berhasil. Terima kasih!');
    // }


   public function bayar($id){
        $transaction = Transaksi::findOrFail($id);
        $transaction->status = 'lunas';
        $transaction->save();

        $wa = new WhatsappService();
        $user = $transaction->user;

        $nomorUser = $user->no_hp;
        $namaUser = $user->nama;

        $pesanUser = "*Pembayaran Berhasil*\n\nHalo {$namaUser},\nTransaksi untuk pembayaran {$transaction->tipe} sebesar Rp " . number_format($transaction->total, 0, ',', '.') . " telah *dibayar*.\n\nTerima kasih!";
        $wa->sendMessage($nomorUser, $pesanUser);

        // Ambil semua admin dari database
        $admins = User::where('role', 'pengelola')->get();
        // Kirim notifikasi ke semua admin
        foreach ($admins as $admin) {
            $pesanAdmin = "*Notifikasi Pembayaran*\nNama: {$namaUser}\nPembayaran: {$transaction->tipe}\nTotal: Rp " . number_format($transaction->total, 0, ',', '.') . "\nStatus: *LUNAS*";
            $wa->sendMessage($admin->no_hp, $pesanAdmin);
        }
        
        return redirect()->back()->with('success', 'Pembayaran berhasil & notifikasi terkirim ke user dan admin.');
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
