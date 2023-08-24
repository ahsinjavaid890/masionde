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
}
