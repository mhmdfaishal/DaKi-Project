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
        return view('marketplace',compact('data_toko','all_data','location'));
    }
    public function detailToko(){

        
    }
}
