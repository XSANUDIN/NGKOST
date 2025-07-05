<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\Transaksi;
use App\Services\WhatsappService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaundryController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('laundry.titip');
    }

    /**
     * Display a listing of the resource.
     */
    public function showStatus()
    {
        
        $user = Auth::id();
        $laundries = Laundry::where('user_id', $user)->orderBy('created_at', 'desc')->get();

        $latestActive = $laundries->where('status', '!=', 'selesai')->first();

        $latestStatus = optional($latestActive ?? $laundries->first())->status ?? 'masuk';

        return view('laundry.status', compact('laundries','latestStatus'));
    }

    /**
     * Display a listing of the resource.
     */
    public function updateStatus()
    {
        //
        $laundries = Laundry::all();
        return view('admin.status', compact('laundries'));

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
            $request->validate([
                'jenis_layanan' => 'required|string',
                'catatan' => 'nullable|string',
                'tanggal' => 'required|date',
            ]);

            $laundry = Laundry::create([
                'user_id' => Auth::id(),
                'jenis_layanan' => $request->jenis_layanan,
                'catatan' => $request->catatan,
                'tanggal' => $request->tanggal,
                'status' => 'masuk',
            ]);


            Transaksi::create([
                'user_id' => Auth::id(),
                'laundry_id' => $laundry->id,
                'tipe' => 'laundry',
                'total' => 0, // biaya akan diisi oleh admin nanti
                'tanggal_transaksi' => now(),
            ]);

            return redirect()->back()->with('success', 'Laundry berhasil dititipkan!');
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
    public function edit(Request $request, string $id)
    {
        //
            $request->validate([
                'berat' => 'nullable',
                'harga' => 'nullable',
                'status' => 'required|in:masuk,dicuci,selesai',
            ]);

            $laundry = Laundry::findOrFail($id);
            $oldStatus = $laundry->status;

            $laundry->update([
                'berat' => $request->berat,
                'harga' => $request->harga,
                'status' => $request->status,
            ]);

            if ($laundry->transaksi) {
                $total = $request->harga;
                $laundry->transaksi->update([
                    'total' => $total,
                ]);
            }


            // Cek apakah status berubah
            if ($oldStatus !== $laundry->status && $laundry->transaksi) {
                $wa = new WhatsappService();
                $user = $laundry->transaksi->user;

                $nomorUser = $user->no_hp;
                $namaUser = $user->nama;

                if ($laundry->status === 'selesai') {
                    // Jika status selesai, info berat dan harga juga
                    $pesanUser = "*Laundry Selesai*\n\nHalo {$namaUser},\nLaundry Anda telah selesai dan akan segera diantarkan.\nBerat: {$laundry->berat} kg\nHarga: Rp " . number_format($laundry->harga, 0, ',', '.') . "\n\nTerima kasih sudah menggunakan layanan kami!";
                } else {
                    // Status lain hanya info status
                    $pesanUser = "*Update Status Laundry*\n\nHalo {$namaUser},\nStatus laundry Anda sedang: *{$laundry->status}*.\n\nTerima kasih sudah menggunakan layanan kami!";
                }

                $wa->sendMessage($nomorUser, $pesanUser);
            }

            return back()->with('success', 'Data laundry berhasil diperbarui.');
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
        Laundry::destroy($id);
        return back()->with('success', 'Data laundry berhasil dihapus.');
    }
}
