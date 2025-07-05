<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.notifikasi');
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
    public function edit()
    {
        //
        $notif = Notifikasi::where('user_id', Auth::id())->first();

        return view('admin.notifikasi', compact('notif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:255',
            'jadwal' => 'required|date',
            'frekuensi' => 'required|in:mingguan,bulanan', 
        ]);



        Notifikasi::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'catatan' => $request->catatan,
                'jadwal' => $request->jadwal,
                'frekuensi' => $request->frekuensi,
            ]
        );

        return back()->with('success', 'Pengaturan notifikasi berhasil disimpan.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
