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

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin/dashboard/index');
    }
    public function allvideos()
    {
        $data = videos::orderby('id' ,'desc')->paginate(6);
        return view('admin.videos.all')->with(array('data' => $data));
    }
    function formatBytes($bytes) {
        if ($bytes > 0) {
            $i = floor(log($bytes) / log(1024));
            $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            return sprintf('%.02F', round($bytes / pow(1024, $i),1)) * 1 . ' ' . @$sizes[$i];
        } else {
            return 0;
        }
    }
    public function createvideo(Request $request)
    {
        $filesize = $request->file('video')->getSize();
        $create  = new videos;
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
    public function updatevideo(Request $request)
    {
        $create  = videos::find($request->id);
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
    public function deleteuser($id)
    {
        DB::table('users')->where('id', $id)->delete();
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
        if ($request->insurancedocument) {

            $update->insurancedocument = Cmf::sendimagetodirectory($request->insurancedocument);
        }
        $update->email = $request->email;
        $update->phone = $request->phone;
        $update->about_me = $request->about_me;
        if ($request->password) {

            $update->password = Hash::make($request->password);
        }
        $update->address = $request->address;
        $update->province = $request->province;
        $update->city = $request->city;
        $update->country = $request->country;
        $update->postal = $request->postal;
        $update->status = $request->status;
        $update->save();
        return redirect()->back()->with('message', 'Agent Updated Successfully');
    }
    public function addnewusers(Request $request)
    {
        $update = new User;
        $update->website = $request->website;
        $update->name = $request->name;
        $update->email = $request->email;
        $update->phone = $request->phone;
        $update->about_me = $request->about_me;
        if ($request->password) {

            $update->password = Hash::make($request->password);
        }
        $update->address = $request->address;
        $update->province = $request->province;
        $update->city = $request->city;
        $update->country = $request->country;
        $update->postal = $request->postal;
        $update->status = 'active';
        $update->type = 'agent';
        $update->save();
        return redirect()->back()->with('message', 'Agent Added Successfully');
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
}
