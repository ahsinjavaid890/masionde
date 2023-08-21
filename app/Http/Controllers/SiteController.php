<?php

namespace App\Http\Controllers;

use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Session;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            if(Auth::user()->type == 'admin')
            {
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('userprofile');    
            }
            
        }else{
            return redirect()->route('login');  
        }
    }
}
