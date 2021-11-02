<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function onRegister(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'nama' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'same:password|required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('landingpage')->withErrors($validator)->withInput()->with('validation_register', 'true');
        }

        User::create([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'role' => 1
        ]);
        return redirect()->route('landingpage');
    }
}
