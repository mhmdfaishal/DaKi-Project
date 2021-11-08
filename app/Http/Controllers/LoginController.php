<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function onLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        
        if ($validator->fails()) {
            return redirect()->route('landingpage')->withErrors($validator)->withInput()->with('validation_login', 'true');
        }
        
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = $request->remember ? true : false;
        if (Auth::attempt($data, $remember)) {
            Auth::logoutOtherDevices($request->password);
            return redirect()->route('index');

        }
  
        return redirect()->route('landingpage')->with('fail_login', 'Email or password are incorrect');
    }

    public function onLogout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
}
