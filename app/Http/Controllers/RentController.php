<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    public function index(){
        $data_toko = Toko::orderBy('rating','DESC')->search(request(['search', 'location']))->paginate(5);
        $all_data = Toko::latest()->paginate(5);
        $location = "";
        if(request('location')){
            $location = request('location');
        }
        if(Auth::check()){
            $nama = explode(" ",strval(Auth::user()->nama));
            return view('marketplace', compact('data_toko','nama','all_data','location'));
        }
        return view('marketplace',compact('data_toko','all_data','location'));
    }
    public function fetchToko(Request $request){
        if($request->ajax())
        {
            $data_toko = Toko::latest()->search(request(['search', 'location']))->paginate(5);
            $all_data = Toko::latest()->get();
            $location = "";
            if(request('location')){
                $location = request('location');
            }

            if(Auth::check()){
                $nama = explode(" ",strval(Auth::user()->nama));
                return view('marketplace_layout', compact('nama','data_toko','all_data','location'));
            }
            return view('marketplace_layout', compact('data_toko','all_data','location'))->render();
        }
    }
    public function detailToko($toko)
    {
        $namatoko = str_replace('-', ' ', strtolower($toko));
        $data_toko = Toko::where('nama_toko',$namatoko)->first();
        $barangs = Barang::latest()->where('toko_id',$data_toko->id)->search(request(['search']))->paginate(16);
        
        $jumlah = $data_toko->barang;
        if(Auth::check()){
            $nama = explode(" ",strval(Auth::user()->nama));
            return view('detail_toko', compact('data_toko','nama','barangs','jumlah'));
        }
        return view('detail_toko',compact('data_toko','barangs','jumlah'));
    }
    public function fetchBarang(Request $request){
        if($request->ajax())
        {
            $barangs = Barang::latest()->where('toko_id',request('id'))->search(request(['search']))->paginate(16);
            if(Auth::check()){
                $nama = explode(" ",strval(Auth::user()->nama));
                return view('list_barang', compact('barangs','nama'));
            }
            return view('list_barang', compact('barangs'))->render();
        }
    }
}
