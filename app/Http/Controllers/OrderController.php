<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\Transaksi;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use DateTime;

class OrderController extends Controller
{
    public function Cart(Request $request){
        $user = Auth::user();
        
        if(Auth::check() && $user->role==2){
            $toko = Toko::where('user_id',$user->id)->first();
            $listpenyewaans = Transaksi::where('toko_id', $toko->id)->orderBy('status','ASC')->get();
            foreach($listpenyewaans as $listpenyewaan){
                $getkeranjang = Keranjang::where('no_transaksi',$listpenyewaan->no_transaksi)->get();
                $listpenyewaan->total_produk = $getkeranjang->count();
                $listpenyewaan->total_harga = "Rp ". number_format($listpenyewaan->total_harga,0,',','.');
                $listpenyewaan->hari = date('d-m-Y',strtotime($listpenyewaan->created_at));
                if($listpenyewaan->status == "0"){
                    $listpenyewaan->status = "Pengecekan";
                }
                elseif($listpenyewaan->status == "1"){
                    $listpenyewaan->status = "Pembayaran ditolak";
                }
                elseif($listpenyewaan->status == "2"){
                    $listpenyewaan->status = "Sedang dikemas";
                }
                elseif($listpenyewaan->status == "3"){
                    $listpenyewaan->status = "Barang siap diambil";
                }
                elseif($listpenyewaan->status == "4"){
                    $listpenyewaan->status = "Barang sudah dikembalikan";
                }

            }
            if($request->ajax()){
                return DataTables::of($listpenyewaans)
                        ->addColumn('pembayaran', function($data){
                                $button = '<a href="'.env('APP_URL').'/storage/images/pembayaran_user/'.$data->bukti_pembayaran.'" target="_blank"><button type="button" data-id="'.$data->no_transaksi.'" id="btn-pembayaran"><i class="fas fa-file-invoice-dollar"></i> Bukti Pembayaran</button></a>';   
                                return $button;
                            })
                            
                        ->addColumn('detail', function($data){
                                $button2 = '<button type="button" data-id="'.$data->no_transaksi.'" id="btn-detail-penyewaan"><i class="fas fa-eye"></i> Detail</button>';   
                                return $button2;
                            })
                            ->rawColumns(['pembayaran','detail'])
                            ->addIndexColumn()
                            ->make(true);
            }
                
            $has_toko = Toko::where('user_id',$user->id)->first();
            $nama = explode(" ",strval($user->nama));
            return view('daftar_pesanan', compact('nama','has_toko'));
        }
        return redirect()->back();

    }
    public function detailPesanan($id){
        if(Auth::check()){
            $user = Auth::user();
            $transaksi = Transaksi::where('no_transaksi',$id)->first();
            $barangs = Keranjang::where('no_transaksi',$id)->get();
            $alat = [];
            foreach($barangs as $k => $barang){
                $alat[$k] = $barang->barang;
            }

            $tanggal = date('d-m-Y',strtotime($transaksi->tanggal_mulai_penyewaan))." s.d. ".date('d-m-Y',strtotime($transaksi->tanggal_selesai_penyewaan));
            return response()->json(['total_semua_harga'=>$transaksi->total_harga,'alat'=>$alat,'keranjang'=>$barangs,'penyewa'=>$transaksi->user->nama,'alamat_user'=>$transaksi->user->alamat,'nama_toko'=>$transaksi->toko->nama_toko,'tanggal'=>$tanggal,'lama_penyewaan'=>$transaksi->total_hari,'status'=>$transaksi->status]);
        }

    }

    public function updateStatus(Request $request){
        if(Auth::check()){
            $updateStatus = Transaksi::where('no_transaksi', $request->no_transaksi)->update([
                'status' => $request->status
            ]);
            
            return response()->json(['message'=>'Update Berhasil', 'status'=>true]);
        }
    }
}
