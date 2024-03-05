<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class katalogController extends Controller
{
    function index() 
    {
        return view('katalog.index');
    }
    function login()
    {
        return view('katalog.login');
    }
    function storelogin(Request $request)
    {   
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'Email Belum Diisi',
            'password.required' => 'Password Belum Diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            if (Auth::user()->role == 'admin'){
                return redirect('access/admin');
            }elseif (Auth::user()-> role == 'user'){
                return redirect('access/user');
            }
        }else{
            return redirect('/login')->withErrors('Email dan Password Tidak Sesuai')->withInput();
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
