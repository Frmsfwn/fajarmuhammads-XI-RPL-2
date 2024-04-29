<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Notifications\EmailVerificationNotification;
use Ichtrojan\Otp\Models\Otp as ModelsOtp;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class emailverificationController extends Controller
{
    function emailverification()
    {
        return view('katalog.emailverification');
    }
    function verifyotp(request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp'               =>  'required|max:6'
        ],[
            'otp.required'      =>  'Enter the OTP code!',
            'otp.max'           =>  'Max length for OTP code is 6 digits'
        ]);

        if ($validator->fails()) {
            return redirect('/emailverification')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            $verify = (new Otp)->validate($request->email, $request->otp);

            if($verify->status == true) {
                $user = user::where('email',$request->email)->first();
                $user->update([
                                'email_verified_at' => now(),
                                'email_verified_status' => 'true'
                            ]);
                Artisan::call('otp:clean');
    
                return redirect('/login')->with('success', $verify->message);
            }else {
                return redirect('/login')->with('error', $verify->message);
            }
        } 
    }
    function resendotp($id)
    {
        $user = user::find($id);
        $identifier = $user->email;
        $old_otp = ModelsOtp::find($identifier);

        if($old_otp == null) {
            $user->notify(new EmailVerificationNotification);
            return redirect('/emailverification');
        }else {
            ModelsOtp::destroy($identifier);

            $user->notify(new EmailVerificationNotification);
            return redirect('/emailverification');
        }
    }
}
