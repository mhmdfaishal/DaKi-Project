<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $guarded = [];

    public function transaksi() {
        return $this->belongsTo(Transaksi::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function toko() {
        return $this->belongsTo(Toko::class);
    }
}
