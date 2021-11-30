<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Follower;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
