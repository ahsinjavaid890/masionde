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
            return route('user.dashboard');
        }else{
            return view('auth.login');
        }
    }
}
