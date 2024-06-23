<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  
use App\Notifications\EmailVerificationNotification;
use Symfony\Component\HttpFoundation\Session\Session;

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
        
        $user = user::create($data);

        $user->notify(new EmailVerificationNotification);

        $session = new Session();
        $session->set('user', $user);
        return redirect('/emailverification');
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

        $user = user::where('email', $request->email)->get();
        $datauser = $user->first();
        $user_password = $datauser->password;
        $inputed_password = $request->password;
        $email_verified_status = $datauser->email_verified_status;

        $verify_password = Hash::check($inputed_password , $user_password);

        if($verify_password === false)
        {
            return redirect('/login')->withErrors('Email dan Password Tidak Sesuai')->withInput();
        }else
        {
            if($email_verified_status == 'false')
            {
                $datauser->notify(new EmailVerificationNotification);

                $session = new Session();
                $session->set('user', $datauser);
                return redirect('/emailverification');
            }elseif($email_verified_status == 'true') 
            {
                if(Auth::attempt($infologin))
                {
                    if (Auth::user()->role == 'admin')
                    {
                        return redirect('/dashboard');
                    }elseif (Auth::user()-> role == 'user') {
                        return redirect('/homepage');
                    }
                }else {
                    return redirect('/login')->withErrors('Email dan Password Tidak Sesuai')->withInput();
                }
            }
        } 
    }
    function logout()
    {
        Auth::logout();
        return redirect('/');
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
