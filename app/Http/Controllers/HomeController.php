<?php

namespace App\Http\Controllers;

use App\Models\Gunung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function landingpage()
    {
        $data_gunung = Gunung::latest()->take(3)->get();
        if(Auth::check()){
            $nama = explode(" ",strval(Auth::user()->nama));
            return view('index', compact('data_gunung','nama'));
        }
        return view('index', compact('data_gunung'));
    }
    public function index()
    {
        // $data_gunung = Gunung::latest()->search(request(['search', 'location']))->paginate(5);
        // $all_data = Gunung::latest()->paginate(5);
        // $location = "";
        // if(request('location')){
        //     $location = request('location');
        // }
        // return view('home', compact('data_gunung','all_data','location'));
        // return response()->json([
        //     'status' => 'success',
        //     'data_gunung' => $data_gunung,
        //     'all_data' => $all_data,
        //     'location' => $location
        // ]);
        if(Auth::check()){
            $nama = explode(" ",strval(Auth::user()->nama));
            return view('home', compact('nama'));
        }
        return view('home');
    }

    public function getGunung() {
        $data_gunung = Gunung::latest()->search(request(['search', 'location']))->paginate(5);
        $all_data = Gunung::latest()->paginate(5);
        $location = "";
        if(request('location')){
            $location = request('location');
        }
        $data = [$data_gunung,$all_data,$location];
        return response()->json([
                'status' => 'success',
                'data' => $data,
        ]);
    }

    public function detail(Gunung $gunung)
    {
        if(Auth::check()){
            $nama = explode(" ",strval(Auth::user()->nama));
            return view('detail_gunung', compact('gunung','nama'));
        }
        return view('detail_gunung',compact('gunung'));
    }

    public function storeGunung(Request $request)
    {
        $gambar = $request->file('gambar');
        $name= $gambar->getClientOriginalName();
        $namafile = uniqid();
        $name= substr(md5($namafile), 6, 6) . '_' . time();
        $folder= 'images/gunung';
        $ext = $gambar->getClientOriginalExtension();
        $gambar->move($folder,"$name.$ext");
        $cekgunung = Gunung::where('nama_gunung',$request->nama)->first();
        if($cekgunung){
            return response()->json(['message'=>'Data Exists!','status' => false]);
        }else{
            $data = Gunung::create([
                'nama_gunung' => $request->nama,
                'gambar_gunung' => $name.".".$ext,
                'lokasi' => $request->lokasi,
                'provinsi' => $request->provinsi,
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
    }
    public function editGunung($gunung){
        return view('detail_gunung',compact('gunung'));
    }
    public function updateGunung(Request $request){
        $gambar = $request->file('gambar');
        $name= $gambar->getClientOriginalName();
        $namafile = uniqid();
        $name= substr(md5($namafile), 6, 6) . '_' . time();
        $folder= 'images/gunung';
        $ext = $gambar->getClientOriginalExtension();
        $gambar->move($folder,"$name.$ext");
        $data = Gunung::where('nama_gunung',$request->nama)->update([
            'gambar_gunung' => $name.".".$ext,
            'lokasi' => $request->lokasi,
            'provinsi' => $request->provinsi,
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

    public function destroyGunung(){
        $data = Gunung::where('nama_gunung', request('nama_gunung'))->first();
        if($data){
            if(file_exists(public_path().'/images/gunung'.$data->gambar_gunung)){
                File::delete(public_path().'/images/gunung'.$data->gambar_gunung);
            }
            $delete = Gunung::where('nama_gunung', request('nama_gunung'))->delete();
            if($delete){
                return response()->json(['message'=>'Delete Succesfully','status' => true]);
            }else{
                return response()->json(['message'=>'Delete Failed','status' => false]);
            }
        }else{
            return response()->json(['message'=>'Data not found!','status' => false]);
        }
    }
}
