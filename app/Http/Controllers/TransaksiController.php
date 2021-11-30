<?php

use App\Models\Tansaksi;
use App\Models\Keranjang;
use App\Models\Barang;
use DateTime;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //
        $gambar = $request->file('bukti_pembayaran');
        $name= $gambar->getClientOriginalName();
        $namafile = uniqid();
        $name= substr(md5($namafile), 6, 6) . '_' . time();
        $ext = $gambar->getClientOriginalExtension();
        $gambar->storeAs('public/images/pembayaran/',"$name.$ext");

        $random_string = Str::random(10);

        $keranjang = Keranjang::where('user_id',Auth::user()->id)->first();
        $getbarang = Keranjang::where('user_id',Auth::user()->id)->get();

        $total_harga = 0;
        foreach($getbarang as $barang){
            $total_harga += $barang->barang->harga;
        }

        $fdate = $request->tanggal_mulai_penyewaan;
        $tdate = $request->tanggal_selesai_penyewaan;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        $data = Transaksi::create([
            'no_transaksi' => $random_string,
            'toko_id' => $keranjang->barang->toko_id,
            'user_id' => Auth::user()->id,
            'bukti_pembayaran' => $name.".".$ext,
            'total_harga' => $total_harga,
            'tanggal_mulai_penyewaan' => $request->tanggal_mulai_penyewaan,
            'tanggal_selesai_penyewaan' => $request->tanggal_selesai_penyewaan,
            'total_hari' => $days,
        ]);

        return $data;
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
