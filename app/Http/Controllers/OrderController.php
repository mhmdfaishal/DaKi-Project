<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function cart(){
        $user = Auth::user();

        if(Auth::check() && $user->role==2){
            return view('daftar_pesanan');
        }
        return redirect()->back();
    }
}
