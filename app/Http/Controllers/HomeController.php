<?php

namespace App\Http\Controllers;

use App\Models\Gunung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function landingpage()
    {
        $data_gunung = Gunung::latest()->take(3)->get();
        return view('index', compact('data_gunung'));
    }
    public function index()
    {
        $data_gunung = Gunung::latest()->search(request(['search', 'filter']))->paginate(5);

        return view('home', compact('data_gunung'));
    }

    public function detail(Gunung $gunung)
    {
        return view('detail_gunung',compact('gunung'));
    }

    public function storeGunung(Request $request)
    {
        $gambar = $request->file('gambar');
        $name= $gambar->getClientOriginalName();
        $namafile = uniqid();
        $name= substr(md5($namafile), 6, 6) . '_' . time();
        $folder= 'images';
        $ext = $gambar->getClientOriginalExtension();
        $gambar->move($folder,"$name.$ext");
        $data = Gunung::create([
            'nama_gunung' => $request->nama,
            'gambar_gunung' => $name,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
            'ketinggian' => $request->ketinggian,
            'htm' => $request->htm,
            'kuota_pendaki' => $request->kuota_pendaki,
            'kontak' => $request->kontak,
            'url_gmaps' => $request->url_gmaps,
        ]);
        if($data){
            return response()->json(['data' => $data,'message'=>'Create Succesfully','status' => true]);
        }else{
            return response()->json(['data' => $data,'message'=>'Create Failed','status' => false]);
        }
    }
    public function editGunung($gunung){
        return view('detail_gunung',compact('gunung'));
    }
    public function updateGunung(Request $request){
        $gambar = $request->file('gambar');
        $name= $gambar->getClientOriginalName();
        $namafile = uniqid();
        $name= substr(md5($namafile), 6, 6) . '_' . time();
        $folder= 'images';
        $ext = $gambar->getClientOriginalExtension();
        $gambar->move($folder,"$name.$ext");
        $data = Gunung::where('nama_gunung',$request->nama)->update([
            'gambar_gunung' => $name,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
            'ketinggian' => $request->ketinggian,
            'htm' => $request->htm,
            'kuota_pendaki' => $request->kuota_pendaki,
            'kontak' => $request->kontak,
            'url_gmaps' => $request->url_gmaps,
        ]);
        if($data){
            return response()->json(['data' => $data,'message'=>'Update Succesfully','status' => true]);
        }else{
            return response()->json(['data' => $data,'message'=>'Update Failed','status' => false]);
        }
    }

    public function destroyGunung(Gunung $gunung){
        $delete = Gunung::where('nama_gunung', $gunung->id)->delete();
        if($delete){
            return response()->json(['message'=>'Delete Succesfully','status' => true]);
        }else{
            return response()->json(['message'=>'Delete Failed','status' => false]);
        }
    }
}
