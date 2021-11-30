<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $guarded = [];

    public function toko(){
        return $this->belongsTo(Toko::class);
    }
    
    public function scopeSearch($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('nama_barang','like',"%". $search."%");
        });
    }
}
