<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function detail(){
        if(Auth::check()){
            $nama = explode(" ",strval(Auth::user()->nama));
            return view('info_toko_admin', compact('nama'));
        }
        return view('info_toko_admin');
    }
}
