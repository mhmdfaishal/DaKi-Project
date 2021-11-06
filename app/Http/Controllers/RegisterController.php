<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    public function onRegister(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'nama' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'same:password|required'
        ]);
        if($request->role == 3){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'nama' => 'required',
                'password' => 'required|min:8',
                'confirm_password' => 'same:password|required',
                'token' => 'required'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'nama' => 'required',
                'password' => 'required|min:8',
                'confirm_password' => 'same:password|required'
            ]);
        }
        
        if ($validator->fails()) {
            return redirect()->route('landingpage')->withErrors($validator)->withInput()->with('validation_register', 'true');
        }
        User::create([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return redirect()->route('landingpage');
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();
            if($user){
                Auth::login($user);
                return redirect()->route('index');
                
            }else{
                return redirect()->route('landingpage')->with(['register_with_google'=>'true','email'=>$user_google->getEmail(),'nama'=>$user_google->getName()]);;
            }

        } catch (\Throwable $th) {
            return redirect()->route('index');
        }

    }
}
