<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Follower;
use App\Models\Keranjang;
use App\Models\Toko;
use App\Models\Transaksi;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RentController extends Controller
{
    public function index(){
        $data_toko = Toko::orderBy('rating','DESC')->search(request(['search', 'location']))->paginate(5);
        $all_data = Toko::latest()->get();
        $location = "";
        if(request('location')){
            $location = request('location');
        }
        if(Auth::check()){
            $user = Auth::user();
            $has_toko = Toko::where('user_id',$user->id)->first();
            $nama = explode(" ",strval($user->nama));
            return view('marketplace', compact('data_toko','nama','all_data','location','has_toko'));
        }
        return view('marketplace',compact('data_toko','all_data','location'));
    }
    public function getPenyewaan(Request $request){
        if(Auth::check()){
            $user = Auth::user();
            $listpenyewaans = Transaksi::where('user_id', $user->id)->orderBy('status','ASC')->get();
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

            }
            if($request->ajax()){
                return DataTables::of($listpenyewaans)
                        ->addColumn('detail', function($data){
                                $button = '<button type="button" data-id="'.$data->no_transaksi.'" id="btn-detail-penyewaan"><i class="fas fa-eye"></i> Detail</button>';   
                                return $button;
                            })
                            ->rawColumns(['detail'])
                            ->addIndexColumn()
                            ->make(true);
            }
                
            $has_toko = Toko::where('user_id',$user->id)->first();
            $nama = explode(" ",strval($user->nama));
            return view('list_penyewaan', compact('nama','has_toko'));
        }
        return redirect()->back();

    }
    public function detailPenyewaan($id){
        if(Auth::check()){
            $user = Auth::user();
            $transaksi = Transaksi::where('no_transaksi',$id)->first();
            $barangs = Keranjang::where('no_transaksi',$id)->get();
            $alat = [];
            foreach($barangs as $k => $barang){
                $alat[$k] = $barang->barang;
            }
            $tanggal = date('d-m-Y',strtotime($transaksi->tanggal_mulai_penyewaan))." s.d. ".date('d-m-Y',strtotime($transaksi->tanggal_selesai_penyewaan));
            return response()->json(['total_semua_harga'=>$transaksi->total_harga,'alat'=>$alat,'keranjang'=>$barangs,'nama'=>$user->nama,'alamat'=>$transaksi->toko->alamat,'nama_toko'=>$transaksi->toko->nama_toko,'tanggal'=>$tanggal,'lama_penyewaan'=>$transaksi->total_hari]);
        }

    }
    public function fetchToko(Request $request){
        if($request->ajax())
        {
            $data_toko = Toko::latest()->search(request(['search', 'location']))->paginate(5);
            
            if(Auth::check()){
                $nama = explode(" ",strval(Auth::user()->nama));
                return view('marketplace_layout', compact('nama','data_toko'));
            }

            return view('marketplace_layout', compact('data_toko'))->render();
        }
    }
    public function fetchLocation(Request $request){
        if($request->ajax())
        {
            $all_data = Toko::latest()->get();
            $location = "";
            if(request('location')){
                $location = request('location');
            }

            if(Auth::check()){
                $nama = explode(" ",strval(Auth::user()->nama));
                return view('location_filter_marketplace', compact('nama','all_data','location'));
            }

            return view('location_filter_marketplace', compact('all_data','location'))->render();
        }
    }
    public function detailToko($toko)
    {
        $user = Auth::user();
        $namatoko = str_replace('-', ' ', strtolower($toko));
        $data_toko = Toko::where('nama_toko',$namatoko)->first();
        $barangs = Barang::latest()->where('toko_id',$data_toko->id)->search(request(['search']))->paginate(16);
        $has_barang = Barang::where('toko_id',$data_toko->id)->get();
        $jumlah = $data_toko->barang;
        if(Auth::check()){
            $user = Auth::user();
            $has_toko = Toko::where('user_id',$user->id)->first();
            $hasfollow = Follower::where('user_id',$user->id)->where('toko_id',$data_toko->id)->first();
            $nama = explode(" ",strval(Auth::user()->nama));
            return view('detail_toko', compact('data_toko','nama','barangs','jumlah','hasfollow','has_toko','has_barang'));
        }
        return view('detail_toko',compact('data_toko','barangs','jumlah','has_barang'));
    }
    public function fetchBarang(Request $request){
        if($request->ajax())
        {            
            $has_barang = Barang::where('toko_id',request('id'))->get();
            $barangs = Barang::latest()->where('toko_id',request('id'))->search(request(['search']))->paginate(16);
            if(Auth::check()){
                $nama = explode(" ",strval(Auth::user()->nama));
                return view('list_barang', compact('barangs','nama','has_barang'));
            }
            return view('list_barang', compact('barangs','has_barang'))->render();
        }
    }
}
