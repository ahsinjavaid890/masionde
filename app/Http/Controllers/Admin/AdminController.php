<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use  Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\videos;
use App\Models\slideshows;
use App\Models\video_categories;
class AdminController extends Controller
{
    function formatBytes($bytes) {
        if ($bytes > 0) {
            $i = floor(log($bytes) / log(1024));
            $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            return sprintf('%.02F', round($bytes / pow(1024, $i),1)) * 1 . ' ' . @$sizes[$i];
        } else {
            return 0;
        }
    }
    public function dashboard()
    {
        return view('admin/dashboard/index');
    }
    public function createcategory(Request $request)
    {
        $add = new video_categories;
        $add->name = $request->name;
        $add->url = Cmf::shorten_url($request->name);
        $add->save();
        return redirect()->back()->with('message', 'Category Added Successfully');   
    }
    public function updatecategory(Request $request)
    {
        $add = video_categories::find($request->id);
        $add->name = $request->name;
        $add->url = Cmf::shorten_url($request->name);
        $add->save();
        return redirect()->back()->with('message', 'Category Updated Successfully');   
    }
    
    public function deletecategory(Request $request)
    {   
        videos::where('category_id' , $request->id)->delete();
        video_categories::where('id' , $request->id)->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }
    public function allvideos()
    {
        $data = videos::orderby('id' ,'desc')->paginate(6);
        return view('admin.videos.all')->with(array('data' => $data));
    }
    public function createvideo(Request $request)
    {
        $getID3 = new \getID3;
        $file = $getID3->analyze($_FILES["video"]["tmp_name"]);
        $filesize = $request->file('video')->getSize();
        $create  = new videos;
        $create->name = $request->name;
        $create->category_id = $request->category_id;
        $create->url = Cmf::shorten_url($request->name);
        $create->short_description = $request->short_description;
        $create->video = Cmf::sendimagetodirectory($request->video);
        $create->filesize = $this->formatBytes($filesize);
        $create->duration = $file['playtime_string'];
        if($request->image)
        {
            $create->image = Cmf::sendimagetodirectory($request->image);
        }
        $create->save();
        return redirect()->back()->with('message', 'Video Uploaded Successfully');
    }
    public function updatevideo(Request $request)
    {

        $create  = videos::find($request->id);
        $create->name = $request->name;
        $create->category_id = $request->category_id;
        $create->url = Cmf::shorten_url($request->name);
        $create->short_description = $request->short_description;
        if($request->video)
        {

            $getID3 = new \getID3;
            $file = $getID3->analyze($_FILES["video"]["tmp_name"]);
            $filesize = $request->file('video')->getSize();
            $create->video = Cmf::sendimagetodirectory($request->video);
            $create->filesize = $this->formatBytes($filesize);
            $create->duration = $file['playtime_string'];
        }
        if($request->image)
        {
            $create->image = Cmf::sendimagetodirectory($request->image);
        }
        $create->save();
        return redirect()->back()->with('message', 'Video Updated Successfully');
    }
    public function searchvideo(Request $request)
    {    
        $data = videos::Where('name', 'like', '%' . $request->keyword . '%')->paginate(100);
        return view('admin.videos.all')->with(array('data' => $data));
    }
    public function deletevideo(Request $request)
    {
        videos::where('id' , $request->id)->delete();
        return redirect()->back()->with('message', 'Video Deleted Successfully');
    }



    public function editvideo($id)
    {
        $video = videos::find($id);
        $data = videos::orderby('id' ,'desc')->whereNotIn('id', [$id])->paginate(6);
        return view('admin.videos.editvideo')->with(array('data' => $data,'video' => $video));
    }
    public function allusers()
    {
        $data = User::all();
        return view('admin.users.allusers')->with(array('data' => $data));
    }
    public function addnewuser()
    {
        return view('admin.users.addnewuser');
    }
    public function edituser($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return view('admin.users.edituser')->with(array('data' => $data));
    }
    public function deleteuser(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        return redirect()->back()->with('message', 'User Deleted Successfully');
    }
    public function profile()
    {
        return view('admin/profile/index');
    }
    public function updateusers(Request $request)
    {
        $update = User::find($request->id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->phonenumber = $request->phonenumber;
        $update->about_me = $request->about_me;
        $update->status = $request->status;
        if ($request->password) {

            $update->password = Hash::make($request->password);
        }
        if($request->profileimage)
        {
            $update->profileimage = Cmf::sendimagetodirectory($request->profileimage);
        }
        $update->save();
        return redirect()->back()->with('message', 'User Updated Successfully');
    }
    public function createuser(Request $request)
    {
        $request->validate(
            [
                'name'              =>      'required|string|max:20',
                'email'             =>      'required|email|unique:users,email',
                'phonenumber'             =>      'required|numeric|min:10',
                'password'          =>      'required|alpha_num|min:6',
                'confirm_password'  =>      'required|same:password'
            ]
        );
        $update = new User;
        $update->name = $request->name;
        $update->email = $request->email;
        $update->phonenumber = $request->phonenumber;
        $update->password = Hash::make($request->password);
        $update->status = 'active';
        $update->type = 'user';
        $update->save();

        Mail::send('email.invite', array('request' => $request , 'adminname' => Auth::user()->name), function ($message) use ($request) {
            $message->to($request->email)->subject('Invitation to Join Masionde');
            $message->from('info@masionde.com', 'Masionde');
        });

        return redirect()->back()->with('message', 'Invitation Sended Successfully');
    }
    public function updateuserprofile(Request $request)
    {
        $update = User::find(Auth::user()->id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->phonenumber = $request->phonenumber;
        $update->about_me = $request->about;
        if ($request->profileimage) {
            $update->profileimage = Cmf::sendimagetodirectory($request->profileimage);
        }
        $update->save();
        return redirect()->back()->with('message', 'Your Profile Updated Successfully');
    }
    public function updateusersecurity(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required',
        ]);
        if ($request->newpassword == $request->password_confirmed) {
            $hashedPassword = Auth::user()->password;
            if (\Hash::check($request->oldpassword, $hashedPassword)) {
                if (!\Hash::check($request->newpassword, $hashedPassword)) {
                    $users = User::find(Auth::user()->id);
                    $users->password = bcrypt($request->newpassword);
                    User::where('id', Auth::user()->id)->update(array('password' =>  $users->password));
                    session()->flash('message', 'password updated successfully');
                    return redirect()->back();
                } else {
                    session()->flash('errorsecurity', 'New password can not be the old password!');
                    return redirect()->back();
                }
            } else {
                session()->flash('errorsecurity', 'Old password Doesnt matched ');
                return redirect()->back();
            }
        } else {
            session()->flash('errorsecurity', 'Repeat password Doesnt matched With New Password');
            return redirect()->back();
        }
    }





    public function allslideshows()
    {
        $data = slideshows::orderby('id' ,'desc')->paginate(6);
        return view('admin.slideshows.all')->with(array('data' => $data));
    }
    public function createslideshow(Request $request)
    {
        $filesize = $request->file('video')->getSize();
        $create  = new slideshows;
        $create->name = $request->name;
        $create->url = Cmf::shorten_url($request->name);
        $create->short_description = $request->short_description;
        $create->video = Cmf::sendimagetodirectory($request->video);
        $create->filesize = $this->formatBytes($filesize);
        if($request->image)
        {
            $create->image = Cmf::sendimagetodirectory($request->image);
        }
        $create->save();
        return redirect()->back()->with('message', 'Video Uploaded Successfully');
    }
    public function updateslideshow(Request $request)
    {
        $create  = slideshows::find($request->id);
        $create->name = $request->name;
        $create->url = Cmf::shorten_url($request->name);
        $create->short_description = $request->short_description;
        if($request->video)
        {
            $filesize = $request->file('video')->getSize();
            $create->video = Cmf::sendimagetodirectory($request->video);
            $create->filesize = $this->formatBytes($filesize);
        }
        if($request->image)
        {
            $create->image = Cmf::sendimagetodirectory($request->image);
        }
        $create->save();
        return redirect()->back()->with('message', 'Video Updated Successfully');
    }
    public function searchslideshow(Request $request)
    {    
        $data = slideshows::Where('name', 'like', '%' . $request->keyword . '%')->paginate(100);
        return view('admin.slideshows.all')->with(array('data' => $data));
    }
    public function deleteslideshow(Request $request)
    {
        slideshows::where('id' , $request->id)->delete();
        return redirect()->back()->with('message', 'Video Deleted Successfully');
    }
    public function editslideshow($id)
    {
        $video = slideshows::find($id);
        $data = slideshows::orderby('id' ,'desc')->whereNotIn('id', [$id])->paginate(6);
        return view('admin.slideshows.edit')->with(array('data' => $data,'video' => $video));
    }
}
