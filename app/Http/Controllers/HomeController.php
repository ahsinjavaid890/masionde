<?php

namespace App\Http\Controllers;
use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\videos;
use App\Models\mywatchvideos;
use App\Models\video_categories;
use App\Models\slideshows;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function dashboard()
    {
        $mywatchvideos = mywatchvideos::orderby('id' , 'desc')->where('user_id' , Auth::user()->id)->limit(4)->get();
        return view('frontend.user.dashboard')->with(array('mywatchvideos' =>$mywatchvideos));
    }
    public function slideshows()
    {
        $data = slideshows::orderby('id' , 'desc')->paginate(8);
        return view('frontend.slideshows.all')->with(array('data' =>$data));
    }
    public function slideshowdetail($id)
    {
        $data = slideshows::where('url' , $id)->first();
        return view('frontend.slideshows.detail')->with(array('data' =>$data));
    }
    public function videos()
    {
        $data = videos::orderby('id' , 'desc')->paginate(8);
        return view('frontend.videos.all')->with(array('data' =>$data));
    }
    public function categorydetail($id)
    {
        $category = video_categories::where('url' , $id)->first();
        $data = videos::orderby('id' , 'desc')->where('category_id' , $category->id)->paginate(8);
        return view('frontend.videos.categorydetail')->with(array('data' =>$data,'category' =>$category));
    }
    public function videodetail($id)
    {
        $data = videos::where('url' , $id)->first();
        $check = mywatchvideos::where('user_id' , Auth::user()->id)->where('video_id' , $data->id)->count();
        if($check > 0)
        {
            mywatchvideos::where('user_id' , Auth::user()->id)->where('video_id' , $data->id)->delete();
            $newdata = new mywatchvideos;
            $newdata->user_id = Auth::user()->id;
            $newdata->video_id = $data->id;
            $newdata->save();
        }else{
            $newdata = new mywatchvideos;
            $newdata->user_id = Auth::user()->id;
            $newdata->video_id = $data->id;
            $newdata->save();
        }

        return view('frontend.videos.detail')->with(array('data' =>$data));
    }
}
