<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function detail(){
        if(Auth::check()){
            $data = Toko::where('user_id',Auth::user()->id)->first();
            $nama = explode(" ",strval(Auth::user()->nama));
            return view('info_toko_admin', compact('nama', 'data'));
        }
    }
    public function storeToko(Request $request){
        $cektoko = Toko::where('user_id',Auth::user()->id)->first();
        if($cektoko){
            if($request->file('gambar_toko')){
                $gambar = $request->file('gambar_toko');
                $name_picture= time(). "_". $gambar->getClientOriginalName();
                $gambar->storeAs('public/images/toko/',$name_picture);

                Storage::delete('public/images/toko/'.$cektoko->logo_toko);
                Toko::where('user_id',Auth::user()->id)->update([
                    'nama_toko' => $request->nama_toko,
                    'logo_toko' => $name_picture,
                    'kotakabupaten' => $request->kotakabupaten,
                    'alamat' => $request->alamat,
                    'kontak' => $request->kontak,
                    'url_gmaps' => $request->url_gmaps
                ]);
                return response()->json(['data' => $cektoko,'message'=>'Update Succesfully','status' => true]);
            } else {
                Toko::where('user_id',Auth::user()->id)->update([
                    'nama_toko' => $request->nama_toko,
                    'kotakabupaten' => $request->kotakabupaten,
                    'alamat' => $request->alamat,
                    'kontak' => $request->kontak,
                    'url_gmaps' => $request->url_gmaps
                ]);
                return response()->json(['data' => $cektoko,'message'=>'Update Succesfully','status' => true]);
            }
        } else {
            if($request->file('gambar_toko')){
                $gambar = $request->file('gambar_toko');
                $name_picture= time(). "_". $gambar->getClientOriginalName();
                $gambar->storeAs('public/images/toko/',$name_picture);
                Toko::create([
                    'user_id' => Auth::user()->id,
                    'nama_toko' => $request->nama_toko,
                    'logo_toko' => $name_picture,
                    'kotakabupaten' => $request->kotakabupaten,
                    'alamat' => $request->alamat,
                    'kontak' => $request->kontak,
                    'url_gmaps' => $request->url_gmaps,
                    'rating' => 0,
                    'follower' => 0
                ]);
                return response()->json(['data' => $cektoko,'message'=>'Update Succesfully','status' => true]);
            } 
        }
    }
}
