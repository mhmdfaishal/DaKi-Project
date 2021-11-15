<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function cart(){
        $user = Auth::user();

        if(Auth::check() && $user->role==2){
            $nama = explode(" ",strval(Auth::user()->nama));
            return view('daftar_pesanan', compact('nama'));
        }
        return redirect()->back();
    }
}
