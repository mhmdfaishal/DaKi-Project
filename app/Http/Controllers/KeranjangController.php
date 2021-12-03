<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Toko;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class KeranjangController extends Controller
{
    public function index(){
        if(Auth::check()){
            $data = Keranjang::where('user_id', Auth::user()->id)->where('no_transaksi',NULL)->get();
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
        $check_if_diff_store = Keranjang::where('user_id', Auth::user()->id)->where('no_transaksi', NULL)->get();
        foreach($check_if_diff_store as $item) {
            $get_data_barang = Barang::where('id', $request->barang_id)->first();
            if ($item->barang->toko_id != $get_data_barang->toko_id) {
                Keranjang::where('barang_id', $item->barang_id)->where('no_transaksi', NULL)->delete();
            }
        }
        $check_barang = Keranjang::where('barang_id', $request->barang_id)->where('user_id',Auth::user()->id)->where('no_transaksi', NULL)->first();
        if($check_barang){
            $kuantitas = $check_barang->kuantitas + $request->quantity;
            $query = $check_barang->update([
                'kuantitas' => $kuantitas
            ]);
            $getkeranjang = Keranjang::where('user_id',Auth::user()->id)->where('no_transaksi', NULL)->get();
            $jumlah=0;
            foreach($getkeranjang as $barang){
                $jumlah += $barang->kuantitas;
            }
            if ($query){
                return response()->json(['jumlah'=>$jumlah, 'message'=>'Berhasil menambahkan ke keranjang','status' => true]);
            } 
            return response()->json(['error'=>'Gagal menambahkan ke keranjang','status' => false]);
        }
        $query = Keranjang::create([
            'barang_id' => $request->barang_id,
            'user_id' => Auth::user()->id,
            'no_transaksi' => null,
            'kuantitas' => $request->quantity
        ]);
        $getkeranjang = Keranjang::where('user_id',Auth::user()->id)->where('no_transaksi', NULL)->get();
        $jumlah=0;
        foreach($getkeranjang as $barang){
            $jumlah += $barang->kuantitas;
        }
        if ($query){
            return response()->json(['jumlah'=>$jumlah,'message'=>'Berhasil menambahkan ke keranjang','status' => true]);
        } 
        return response()->json(['error'=>'Gagal menambahkan ke keranjang','status' => false]);
    }
    public function storeMinus(Request $request){
        if(Auth::check()){
            $check_barang = Keranjang::where('barang_id', $request->barang_id)->where('user_id',Auth::user()->id)->where('no_transaksi',NULL)->first();
            if($check_barang){
                $kuantitas = $check_barang->kuantitas - 1;
                if($kuantitas < 0){
                    $kuantitas = 0;
                }
                $query = $check_barang->update([
                    'kuantitas' => $kuantitas
                ]);
                $keranjangs = Keranjang::where('user_id',Auth::user()->id)->where('no_transaksi',NULL)->get();
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
            $check_barang = Keranjang::where('barang_id', $request->barang_id)->where('user_id',Auth::user()->id)->where('no_transaksi',NULL)->first();
            if($check_barang){
                $kuantitas = $check_barang->kuantitas + 1;
                $query = $check_barang->update([
                    'kuantitas' => $kuantitas
                ]);
                $keranjangs = Keranjang::where('user_id',Auth::user()->id)->where('no_transaksi',NULL)->get();
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
            $check_barang = Keranjang::where('barang_id', $id)->where('no_transaksi',NULL)->first();
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
            $user = Auth::user();
            $has_toko = Toko::where('user_id',$user->id)->first();
            $nama = explode(" ",strval(Auth::user()->nama));
            $keranjangs = Keranjang::where('user_id',$user->id)->where('no_transaksi', NULL)->get();
            $total_harga = 0;
            foreach($keranjangs as $barang){
                $total_harga += $barang->barang->harga * $barang->kuantitas;
                $no_rek = $barang->barang->toko->no_rek;
                $nama_rek = $barang->barang->toko->nama_rek;
                $provider_rek = $barang->barang->toko->provider_rek;
            }
            return view('pembayaran',compact('user','nama','has_toko','keranjangs','total_harga','no_rek','nama_rek','provider_rek'));
        }
        return redirect()->back();
    }
    public function tanggalSewa(Request $request){
        if(Auth::check()){
            $user = Auth::user();
            $keranjangs = Keranjang::where('user_id',$user->id)->where('no_transaksi',NULL)->get();
            $total_harga = 0;
            $tanggal_start = new DateTime($request->mulai);
            $tanggal_end = new DateTime($request->selesai);
            $selisih_hari = $tanggal_end->diff($tanggal_start)->format("%a");

            foreach($keranjangs as $barang){
                $total_harga += $barang->barang->harga * $barang->kuantitas;
            }
            $total_harga = $total_harga * $selisih_hari;

            return response()->json($total_harga);
        }
    }
}
