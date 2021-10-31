<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gunung extends Model
{
    protected $table = 'gunung';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('nama_gunung', 'like', "%" . $search . "%");
        });

        $query->when($filters['filter'] ?? false, function($query, $lokasi){
            return $query->where('lokasi', 'like', "%" . $lokasi . "%");
        });

    }
}
