<?php

namespace App\Http\Controllers;

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
}
