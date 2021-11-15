<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $fillable = [
        'token_value',
        'user_email'
    ];

    public function token() {
        return $this->belongsTo(User::class);
    }

}