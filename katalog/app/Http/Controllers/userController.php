<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    function register()
    {
        return view('katalog.register');
    }
    function storeregister(Request $request)
    {
        $request->validate([
            'name'      =>  'required',
            'gender'    =>  'required',
            'number'    =>  'required|numeric',
            'email'     =>  'required|indisposable|unique:users,email',
            'username'  =>  'required',
            'password'  =>  'required'
        ],[
            'name.required'     =>  'Enter your Name!',
            'gender.required'   =>  'Select Gender!',
            'number.required'   =>  'Enter your Phone Number!',
            'number.numeric'    =>  'The Field must be a Number!',
            'email.required'    =>  'Enter your Email!',
            'email.unique'      =>  'Email is Already Used!',
            'username.required' =>  'Enter Username!',
            'password.required' =>  'Enter your Password!'
        ]);
    }
    function admin()
    {
        echo "Selamat Datang, Admin!";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='/logout'>Logout >></a>";
    }
    function user()
    {
        echo "Selamat Datang, User!";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='/logout'>Logout >></a>";
    }
}
