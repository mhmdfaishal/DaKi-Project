<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            if($request->file('bukti_pembayaran')){
                $gambar = $request->file('bukti_pembayaran');
                $name= $gambar->getClientOriginalName();
                $namafile = uniqid();
                $name= substr(md5($namafile), 6, 6) . '_' . time();
                $ext = $gambar->getClientOriginalExtension();
                $gambar->storeAs('public/images/pembayaran_user/',"$name.$ext");
    
                $random_string = Str::random(10);
    
                $user = Auth::user();
    
                $toko_barang = Keranjang::where('user_id',Auth::user()->id)->first();
                $getbarang = Keranjang::where('user_id',Auth::user()->id)->where('no_transaksi',NULL)->get();
    
                $total_harga = 0;
                foreach($getbarang as $barang){
                    $total_harga += $barang->barang->harga * $barang->kuantitas;
                }
                $tanggal=explode("-", $request->tanggal_sewa);
    
                $tanggal_mulai= $tanggal[0];
                $tanggal_kembali= $tanggal[1];
    
                $tanggal_mulai = new DateTime($tanggal_mulai);
                $tanggal_kembali = new DateTime($tanggal_kembali);
                $selisih_hari = $tanggal_kembali->diff($tanggal_mulai)->format('%a');
                
                $total_harga = $total_harga * $selisih_hari;
                $data = Transaksi::create([
                    'no_transaksi' => $random_string,
                    'toko_id' => $toko_barang->barang->toko_id,
                    'user_id' => $user->id,
                    'bukti_pembayaran' => $name.".".$ext,
                    'total_harga' => $total_harga,
                    'tanggal_mulai_penyewaan' => $tanggal_mulai,
                    'tanggal_selesai_penyewaan' => $tanggal_kembali,
                    'total_hari' => $selisih_hari,
                    'status' => "0",
                ]);
                $data = Keranjang::where('user_id',Auth::user()->id)->where('no_transaksi',NULL)->update([
                    'no_transaksi' => $data->no_transaksi,
                ]);
                if($data){
                    return response()->json($data);
                }
            }else{
                return response()->json(['error' => 'Bukti pembayaran belum diupload!','status'=>false]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
