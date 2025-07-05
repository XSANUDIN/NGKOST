<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    protected $table = 'laundry';
    //

    protected $fillable = [
        'user_id',
        'jenis_layanan',
        'catatan',
        'tanggal',
        'harga',
        'status',
        'berat',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function transaksi(){
        return $this->hasOne(Transaksi::class);
    }
}
