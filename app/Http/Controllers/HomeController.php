<?php

namespace App\Http\Controllers;

use App\Models\Gunung;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landingpage(){
        $data_gunung = Gunung::where('status','Buka')->latest()->take(3)->get();

        return response()->json($data_gunung);
    }
    public function index(){
        $data_gunung = Gunung::latest()->search(request(['search','filter']))->paginate(5);

        return response()->json($data_gunung);
    }

    public function detail(){
        
    }
}
