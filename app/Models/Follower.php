<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $table = 'followers';
    protected $guarded = [];

    public function toko(){
        return $this->hasMany(Toko::class);
    }
}
