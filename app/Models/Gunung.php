<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gunung extends Model
{
    protected $table = 'gunung';
    protected $guarded = [];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function provinsi(){
        return $this->belongsTo(Provinces::class);
    }

    public function scopeSearch($query, array $filters){
        $query->when($filters['location'] ?? false, function($query, $location){
            return $query->where('provinsi_id',  'like',"%". $location."%");
        });

        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('nama_gunung','like',"%". $search."%");
        });
    }
}
