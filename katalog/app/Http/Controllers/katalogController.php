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
            return redirect('/admin');
        }else{
            return redirect('/login')->withErrors('Email dan Password Tidak Sesuai')->withInput();
        }
    }
    function admin()
    {
        echo "Selamat Datang";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='Logut'>Logout >></a>";
    }
    
}
