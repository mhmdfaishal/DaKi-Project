<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function keranjang(){
        return $this->hasMany(keranjang::class);
    }
    public function toko(){
        return $this->belongsTo(Toko::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
