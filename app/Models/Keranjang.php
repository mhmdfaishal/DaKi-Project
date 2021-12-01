<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $fillable = [
        'barang_id',
        'user_id',
        'no_transaksi',
        'kuantitas'
    ];

    public function barang() {
        return $this->belongsTo(Barang::class);
    }

    public function user() {
        return $this->hasMany(User::class);
    }

    public function toko() {
        return $this->hasMany(Toko::class);
    }
}
