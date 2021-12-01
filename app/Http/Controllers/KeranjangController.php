<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Toko;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index(){
        if(Auth::check()){
            $data = Keranjang::where('user_id', Auth::user()->id)->get();
            if($data){
                $user = Auth::user();
                $has_toko = Toko::where('user_id',$user->id)->first();
                $nama = explode(" ",strval(Auth::user()->nama));
                $total_harga = 0;
                foreach($data as $barang){
                    $total_harga += $barang->barang->harga*$barang->kuantitas;
                }
                return view('keranjang',compact('data','nama','has_toko','total_harga'));
            }
        }
        return redirect()->back();
    }

    public function addBarang(Request $request){
        $check_barang = Keranjang::where('barang_id', $request->barang_id)->where('user_id',Auth::user()->id)->first();
        if($check_barang){
            $kuantitas = $check_barang->kuantitas + $request->quantity;
            $query = $check_barang->update([
                'kuantitas' => $kuantitas
            ]);
            if ($query){
                return response()->json(['message'=>'Berhasil menambahkan ke keranjang','status' => true]);
            } 
            return response()->json(['error'=>'Gagal menambahkan ke keranjang','status' => false]);
        }
        $query = Keranjang::create([
            'barang_id' => $request->barang_id,
            'user_id' => Auth::user()->id,
            'no_transaksi' => null,
            'kuantitas' => $request->quantity
        ]);
        if ($query){
            return response()->json(['message'=>'Berhasil menambahkan ke keranjang','status' => true]);
        } 
        return response()->json(['error'=>'Gagal menambahkan ke keranjang','status' => false]);
    }
    public function storeMinus(Request $request){
        if(Auth::check()){
            $check_barang = Keranjang::where('barang_id', $request->barang_id)->where('user_id',Auth::user()->id)->first();
            if($check_barang){
                $kuantitas = $check_barang->kuantitas - 1;
                if($kuantitas < 0){
                    $kuantitas = 0;
                }
                $query = $check_barang->update([
                    'kuantitas' => $kuantitas
                ]);
                $keranjangs = Keranjang::where('user_id',Auth::user()->id)->get();
                $total_harga = $check_barang->barang->harga*$kuantitas;
                $total_keseluruhan_harga = 0;
                foreach($keranjangs as $keranjang){
                    $total_keseluruhan_harga += $keranjang->barang->harga * $keranjang->kuantitas;
                }
                if ($query){
                    return response()->json(['data'=>$check_barang,'total_keseluruhan_harga'=>$total_keseluruhan_harga,'total_harga'=>$total_harga,'message'=>'Berhasil mengurangi barang','status' => true]);
                } 
            }
            return response()->json(['error'=>'Gagal mengurangi barang','status' => false]);
        }
    }
    public function storePlus(Request $request){
        if(Auth::check()){
            $check_barang = Keranjang::where('barang_id', $request->barang_id)->where('user_id',Auth::user()->id)->first();
            if($check_barang){
                $kuantitas = $check_barang->kuantitas + 1;
                $query = $check_barang->update([
                    'kuantitas' => $kuantitas
                ]);
                $keranjangs = Keranjang::where('user_id',Auth::user()->id)->get();
                $total_harga = $check_barang->barang->harga*$kuantitas;
                $total_keseluruhan_harga = 0;
                foreach($keranjangs as $keranjang){
                    $total_keseluruhan_harga += $keranjang->barang->harga * $keranjang->kuantitas;
                }
                if ($query){
                    return response()->json(['data'=>$check_barang,'total_keseluruhan_harga'=>$total_keseluruhan_harga,'total_harga'=>$total_harga,'message'=>'Berhasil mengurangi barang','status' => true]);
                } 
            }
            return response()->json(['error'=>'Gagal mengurangi barang','status' => false]);
        }
    }
    public function deleteBarang($id){
        if(Auth::check()){
            $check_barang = Keranjang::where('barang_id', $id)->first();
            if($check_barang){
                $query = $check_barang->delete();
                if ($query){
                    return response()->json(['message'=>'Berhasil menghapus barang','status' => true]);
                } 
                return response()->json(['error'=>'Gagal menghapus barang','status' => false]);
            }
        }
    }
    public function checkout(){
        if(Auth::check()){
            
        }
    }
}
