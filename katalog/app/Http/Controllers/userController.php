<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\user;
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

        $data = [
            'name'      =>  $request->name,
            'gender'    =>  $request->gender,
            'number'    =>  $request->number,
            'email'     =>  $request->email,
            'username'  =>  $request->username,
            'password'  =>  $request->password,
		];
        user::create($data);
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
                return redirect('/dashboard');
            }elseif (Auth::user()-> role == 'user'){
                return redirect('/homepage');
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
    function deleteuser(user $user)
    {
        user::destroy($user->id);
        return redirect(route('admin.dashboard'))->with('success', 'User Deleted!');
    }
    function admin()
    {
        return redirect('/dashboard');
    }
    function user()
    {
        return redirect('/homepage');
    }
}
