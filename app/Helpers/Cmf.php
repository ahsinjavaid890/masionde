<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\staff_permissions;
use App\Models\set_roles;
use App\Models\role_users;
use App\Models\companies;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
class Cmf
{

    public static function gettimeforday()
    {
        /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        $timezone = date("e");
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            return "Good Morning";
        } else
        /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
        if ($time >= "12" && $time < "17") {
            return "Good After Noon";
        } else
        /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
        if ($time >= "17" && $time < "19") {
            return "Good Evening";
        } else
        /* Finally, show good night if the time is greater than or equal to 1900 hours */
        if ($time >= "19") {
            return "Good Night";
        }
    }


    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }
    public static function getsite()
    {
        return 'lifeadvice';
    }
    public static function getwebsite()
    {
        $data =  DB::table('select_websites')->where('id' ,1)->first();
        return DB::table('site_settings')->where('smallname' ,$data->name)->first();
    }
    public static function sendimagetodirectory($imagename)
    {
        $file = $imagename;
        $filename = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        return $filename;
    }
    public static function section_three_elements($page , $coloumn , $id)
    {
        return DB::table('section_three_elements')->where('id' , $id)->where('page' , $page)->first()->$coloumn;
    }
    public static function shorten_url($text)
    {
        $words = explode('-', $text);
        $five_words = array_slice($words,0,12);
        $String_of_five_words = implode('-',$five_words)."\n";

        $String_of_five_words = preg_replace('~[^\pL\d]+~u', '-', $String_of_five_words);
        $String_of_five_words = iconv('utf-8', 'us-ascii//TRANSLIT', $String_of_five_words);
        $String_of_five_words = preg_replace('~[^-\w]+~', '', $String_of_five_words);
        $String_of_five_words = trim($String_of_five_words, '-');
        $String_of_five_words = preg_replace('~-+~', '-', $String_of_five_words);
        $String_of_five_words = strtolower($String_of_five_words);
        if (empty($String_of_five_words)) {
          return 'n-a';
        }
        return $String_of_five_words;
    }
    public static function create_time_ago($time)
    {

        $year = date('Y', strtotime($time));
        $month = date('m', strtotime($time));
        $day = date('d', strtotime($time));
        $datetime = Carbon::parse($time);
        return $datetime->diffForHumans();
    }
    public static function date_format($data)
    {
        return date('d M Y', strtotime($data));
    }
    public static  function getusercompany()
    {
        if(Auth::user()->type == 'carrier_sub_account')
        {
            $roleid = role_users::where('user_id' , Auth::user()->id)->first();
            $companyid = staff_permissions::where('id' , $roleid->role_id)->first();
            $companyid = companies::where('id' , $companyid->company_id)->first();
        }else{
            $companyid = companies::where('user_id' , Auth::user()->id)->first();
        }
        return $companyid;
    }

    public static function getuserrole($id)
    {
        $roleid = role_users::where('user_id' , $id)->first();
        return $userrole = staff_permissions::where('id' , $roleid->role_id)->first();
    }

    public static function getcarrierrole($id)
    {
        $checkrole = role_users::where('user_id' , Auth::user()->id)->get();
        if($checkrole->count() > 0)
        {
            $role = $checkrole->first()->role_id;
            $checkmodule = set_roles::where('staff_permissions' , $role)->where('module_id' , $id)->count();
            if($checkmodule > 0)
            {
                return 1;
            }else{
                return 2;
            }
        }
        else
        {
            return 0;
        }
    }
    public static function get_store_value($value)
    {
        return DB::table('site_settings')->where('id' , 1)->get()->first()->$value;
    }
    public static function travelpages()
    {
        $travel = array(
          array("id"=>1,"modalname"=>'supervisainsurance',"name"=>'Super Visa'),
          array("id"=>2,"modalname"=>'travelinsurance',"name"=>'Travel Insurance'),
          array("id"=>3,"modalname"=>'visitorinsurance',"name"=>'Visitor Insurance'),
          array("id"=>4,"modalname"=>'studentinsurance',"name"=>'Student Insurance')
        );
        return $travel;
    }
}