<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    public function onRegister(Request $request) {
        
        if($request->role == 3){
            $check_token = Token::where('token_value', $request->token)->first();
            if($check_token == null || $check_token->user_email != null){
                return redirect()->route('landingpage')->withInput()->with('validation_token', 'true');
            } else {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users',
                    'nama' => 'required',
                    'password' => 'required|min:8',
                    'confirm_password' => 'same:password|required',
                    'token' => 'required'
                ]);
                if ($validator->fails()) {
                    return redirect()->route('landingpage')->withErrors($validator)->withInput()->with('validation_register', 'true');
                }
                Token::where('token_value', $request->token)->update([
                    'user_email' => $request->email
                ]);
            } 
        }else{
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'nama' => 'required',
                'password' => 'required|min:8',
                'confirm_password' => 'same:password|required'
            ]);
            if ($validator->fails()) {
                return redirect()->route('landingpage')->withErrors($validator)->withInput()->with('validation_register', 'true');
            }
        }
        
        $user = User::create([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        Auth::login($user);
        return redirect()->route('index');
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
