<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    private $otp;

    function _construct() {
        $this->otp = new Otp;
    }

    function emailverification(request $request, $email)
    {
        $request->validate([
            'otp'        =>  'required|max:6'
        ],[
            'otp.required'      =>  'Enter the OTP code!',
            'otp.max'           =>  'Max length for OTP code is 6 digits'
        ]);

        $verify = $this->otp->validate($email, $request->otp);
        if(!$verify->status == true) {
            return redirect('/login')->with('Email Verified!', 'Now, You can Login here..');

            u
        }elseif(!$verify->status){
            return redirect('/emailverification')->('Email not Verified!', $verify->message);
        }
        $user = user::where('email',$request->email)->first();
        $user->update(['email_verified_at' => now()]);
        $success['success'] = true;
        return response()->json($success,200);
    }

    function resendemailverification(request $request)
    {
        $request->user()->notify(new EmailVerificationNotification());
        $success['success'] = true;
        return response()->json($success,200);
    }
}
