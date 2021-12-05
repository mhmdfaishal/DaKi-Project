<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendakiController extends Controller
{
    public function index(){
        if(Auth::check()){
            $getuser = User::where('id',Auth::user()->id)->first();
            $nama = explode(" ",strval(Auth::user()->nama));
            $has_toko = Toko::where('user_id',Auth::user()->id)->first();
            return view('profile_user',compact('nama','getuser','has_toko'));
        }
    }
    public function store(Request $request){
        if(Auth::check()){
            if(Auth::user()->role == "1"){
                $cek_email = User::where('email',$request->email)->first();
                if($cek_email && $cek_email->id != Auth::user()->id){
                    return response()->json(['error'=>'Email sudah terdaftar','status'=>false]);
                }
                if($request->password != ""){
                    $getuser = User::where('id',Auth::user()->id)->update([
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'alamat' => $request->alamat,
                        'password' => $request->password
                    ]);
                }else{
                    $getuser = User::where('id',Auth::user()->id)->update([
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'alamat' => $request->alamat,
                    ]);
                }
                if($getuser){
                    return response()->json(['message'=>'Data berhasil diperbaharui','status'=>true]);
                }else{
                    return response()->json(['error'=>'Data gagal diperbaharui','status'=>false]);
                }
            }
        }
    }
}
