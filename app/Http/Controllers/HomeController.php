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
        $data_gunung = Gunung::orderBy('ketinggian','DESC')->search(request(['search', 'location']))->paginate(5);
        $all_data = Gunung::latest()->get();
        $location = "";
        if(request('location')){
            $location = request('location');
        }

        if(Auth::check()){
            $nama = explode(" ",strval(Auth::user()->nama));
            return view('home', compact('nama','data_gunung','all_data','location'));
        }
        return view('home',compact('data_gunung','all_data','location'));
    }

    public function fetchGunung(Request $request){
        if($request->ajax())
        {
            $data_gunung = Gunung::orderBy('ketinggian','DESC')->search(request(['search', 'location']))->paginate(5);
            if(Auth::check()){
                $nama = explode(" ",strval(Auth::user()->nama));
                return view('home_layout', compact('nama','data_gunung'));
            }
            return view('home_layout', compact('data_gunung'))->render();
        }
    }
    public function fetchLocation(Request $request){
        if($request->ajax())
        {
            $all_data = Gunung::latest()->get();
            $location = "";
            if(request('location')){
                $location = request('location');
            }

            if(Auth::check()){
                $nama = explode(" ",strval(Auth::user()->nama));
                return view('location_filter', compact('nama','all_data','location'));
            }
            return view('location_filter', compact('all_data','location'))->render();
        }
    }

    public function getGunung() {
        $data_gunung = Gunung::latest()->search(request(['search', 'location']))->paginate(5);
        $all_data = Gunung::latest()->get();
        $location = "";
        if(request('location')){
            $location = request('location');
        }
        $data = [$data_gunung,'data'=> $all_data,$location];
        return response()->json([
                'status' => 'success',
                'data' => $data,
        ]);
    }

    public function detail(Gunung $gunung){
        if(Auth::check()){
            $nama = explode(" ",strval(Auth::user()->nama));
            return view('detail_gunung', compact('gunung','nama'));
        }
        return view('detail_gunung',compact('gunung'));
    }

}
