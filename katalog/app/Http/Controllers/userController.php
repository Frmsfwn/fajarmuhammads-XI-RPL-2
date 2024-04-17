<?php

namespace App\Http\Controllers;

use App\Models\user;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EmailVerificationNotification;

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

        return view('katalog.emailverification')->with('email', $user->email);
    }

    

    function emailverification(request $request)
    {
        $request->validate([
            'otp'               =>  'required|max:6'
        ],[
            'otp.required'      =>  'Enter the OTP code!',
            'otp.max'           =>  'Max length for OTP code is 6 digits'
        ]);

        $verify = (new Otp)->validate($request->email, $request->otp);

        if($verify->status == true) {
            $user = user::where('email',$request->email)->first();
            $user->update(['email_verified_at' => now()]);

            return redirect('/login')->with('success', $verify->message);
        }elseif($verify->status){
            return redirect('/login')->with('error', $verify->message);
        }
    }

    function resendemailverification(request $request)
    {
        $request->user()->notify(new EmailVerificationNotification());
        $success['success'] = true;
        return response()->json($success,200);
    }

    function storeuserdata()
    {

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
