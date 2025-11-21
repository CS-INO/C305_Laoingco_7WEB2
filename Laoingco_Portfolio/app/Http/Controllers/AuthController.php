<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function showRegister()
    {
        return view('authentication.register');
    }
    function register (Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:users',
            'password' =>'required|min:5|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            
        ]);
        User::create([
            'name'      =>$request->name,
            'email'     =>$request->email,
            'password'  =>Hash::make($request->password)
        ]);
        return redirect()->route('login.form')->with('succes', 'Registration Successful');
    }

    function showLogin() {return view ('authentication.login');}
    public function login(Request $request){
        $credentials = $request->validate ([
            'email'     => 'required|email',
            'password' => 'required'
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
            
        }
        return back()->withErrors([
            'email' => 'Invalid email/password!'
        ]);
    }
}