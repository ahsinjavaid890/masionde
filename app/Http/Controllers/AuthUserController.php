<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\userfields;
use Illuminate\Support\Str;
use App\Helpers\Cmf;
use DB; 
use Carbon\Carbon; 
use Mail; 
use App\Models\subscribedplans;
use App\Models\payments;
use URL;
use Session;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
class AuthUserController extends Controller
{
    // Customer Auth
    public function signin()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }else{
            return view('auth.signin');
        }
    }

    public function login(Request $request)
    {   
     
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|exists:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {   

            if(Auth::user()->type == 'user')
            {
                if (Auth::user()->status == 'active') {
                    return redirect()->route('user.home');
                }else{
                    Auth::logout();
                    return redirect()->back()->with('error', 'Your Account is Banned');
                }
            }
            else
            {
                Auth::logout();
                return redirect()->back()->with('error', 'This is Not Admin Portal');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Email or Password are Wrong');
        }
          
    }


    
      
        public function showForgetPasswordForm()
        {
           return view('auth.forgetPassword');
        }
    
        
        public function submitForgetPasswordForm(Request $request)
        {
            $request->validate([
                'email' => 'required|email|exists:users',
            ]);
    
            $token = Str::random(64);
    
            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
              ]);
    
            Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });
    
            return back()->with('message', 'We have e-mailed your password reset link!');
        }
      
        public function showResetPasswordForm($token) { 
           return view('auth.forgetPasswordLink', ['token' => $token]);
        }
    
        
        public function submitResetPasswordForm(Request $request)
        {
            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required'
            ]);
    
            $updatePassword = DB::table('password_resets')
                                ->where([
                                  'email' => $request->email, 
                                  'token' => $request->token
                                ])
                                ->first();
    
            if(!$updatePassword){
                return back()->withInput()->with('error', 'Invalid token!');
            }
    
            $user = User::where('email', $request->email)
                        ->update(['password' => Hash::make($request->password)]);
   
            DB::table('password_resets')->where(['email'=> $request->email])->delete();
    
            return redirect('/login')->with('message', 'Your password has been changed!');
        }
  
}
