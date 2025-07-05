<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{

    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $userId = Auth::id();

        // Fetch all transactions that belong to the user
        $transaksi = Transaksi::where('user_id', $userId)->get();

        // Pass the collection of transactions to the view
        return view('guest.home', compact('transaksi'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.dashboard');
    }

        /**
     * Display a listing of the resource.
     */
    public function admin()
    {
        $pendapatanSewa = Transaksi::where('tipe', 'sewa')->where('status', 'lunas')->sum('total');
        $pendapatanLaundry = Transaksi::where('tipe', 'laundry')->where('status', 'lunas')->sum('total');
        $jumlahPenghuni = User::all()->count();

        $aktivitasTerbaru = Transaksi::with('user')
            ->latest('tanggal_transaksi')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'pendapatanSewa',
            'pendapatanLaundry',
            'jumlahPenghuni',
            'aktivitasTerbaru'
        ));
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
