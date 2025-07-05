<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    protected $table = 'transaksi';


    protected $fillable = [
        'user_id',
        'laundry_id',
        'tipe',
        'total',
        'status',
        'tanggal_transaksi',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function laundry(){
        return $this->belongsTo(Laundry::class);
    }
}
