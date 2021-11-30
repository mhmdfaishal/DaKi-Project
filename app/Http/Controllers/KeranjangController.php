<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index(){
        $data = Keranjang::where('user_id', Auth::user()->id)->get();
        return response()->json($data);
    }

    public function addBarang(Request $request){
        $check_barang = Keranjang::where('id_barang', $request->id_barang)->where('user_id',Auth::user()->id)->first();
        if($check_barang){
            $kuantitas = $check_barang->kuantitas + $request->quantity;
            $query = $check_barang->update([
                'kuantitas' => $kuantitas
            ]);
            if ($query){
                return response()->json(['message'=>'Add to Cart Succesfully','status' => true]);
            } 
            return response()->json(['message'=>'Add to Cart Failed','status' => false]);
        }
        $query = Keranjang::create([
            'id_barang' => $request->id_barang,
            'user_id' => Auth::user()->id,
            'no_transaksi' => null,
            'kuantitas' => $request->quantity
        ]);
        if ($query){
            return response()->json(['message'=>'Add to Cart Succesfully','status' => true]);
        } 
        return response()->json(['message'=>'Add to Cart Failed','status' => false]);
    }
}
