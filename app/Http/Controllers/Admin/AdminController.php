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
use App\Models\slideshow_categories;
use App\Models\quizzes;
use App\Models\questions;
use App\Models\answers;
use App\Models\user_notifications;
use App\Models\userquizes;
use App\Models\mywatchvideos;
use App\Models\user_positions;
use App\Models\userquizes_answers;

class AdminController extends Controller
{
    function formatBytes($bytes)
    {
        if ($bytes > 0) {
            $i = floor(log($bytes) / log(1024));
            $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            return sprintf('%.02F', round($bytes / pow(1024, $i), 1)) * 1 . ' ' . @$sizes[$i];
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
        if ($request->tablename == 'slideshow_categories') {
            $add = new slideshow_categories;
            $add->name = $request->name;
            $add->url = Cmf::shorten_url($request->name);
            $add->save();
        } else {
            $add = new video_categories;
            $add->name = $request->name;
            $add->url = Cmf::shorten_url($request->name);
            $add->save();
        }
        return redirect()->back()->with('message', 'Category Added Successfully');
    }
    public function updatecategory(Request $request)
    {

        if($request->tablename == 'slideshow_categories')
        {
            slideshow_categories::where('id' , $request->id)->update(array('name' => $request->name,'url' => Cmf::shorten_url($request->name)));
        }
        if($request->tablename == 'video_categories'){
            video_categories::where('id' , $request->id)->update(array('name' => $request->name,'url' => Cmf::shorten_url($request->name)));
        }
        return redirect()->back()->with('message', 'Category Updated Successfully');
    }

    public function deletecategory(Request $request)
    {
        if ($request->tablename == 'slideshow_categories') {
            slideshows::where('category_id', $request->id)->delete();
            slideshow_categories::where('id', $request->id)->delete();
        } else {
            videos::where('category_id', $request->id)->delete();
            video_categories::where('id', $request->id)->delete();
        }

        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }
    public function allvideos()
    {
        $data = videos::orderby('id', 'desc')->paginate(6);
        return view('admin.videos.all')->with(array('data' => $data));
    }
    public function createvideo(Request $request)
    {
        $create  = new videos;
        $create->name = $request->name;
        $create->category_id = $request->category_id;
        $create->url = Cmf::shorten_url($request->name);
        $create->short_description = $request->short_description;
        $create->video = $request->video;
        $create->filesize = '';
        $create->duration = '';
        if ($request->image) {
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
        $create->video = $request->video;
        $create->filesize = '';
        $create->duration = '';
        if ($request->image) {
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
        mywatchvideos::where('video_id' , $request->id)->delete();
        videos::where('id', $request->id)->delete();
        return redirect()->back()->with('message', 'Video Deleted Successfully');
    }



    public function editvideo($id)
    {
        $video = videos::find($id);
        $data = videos::orderby('id', 'desc')->whereNotIn('id', [$id])->paginate(6);
        return view('admin.videos.editvideo')->with(array('data' => $data, 'video' => $video));
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
        userquizes::where('user_id' , $request->id)->delete();
        user_notifications::where('user_id' , $request->id)->delete();
        user_positions::where('user_id' , $request->id)->delete();
        mywatchvideos::where('user_id' , $request->id)->delete();
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
        if($request->password)
        {
            $update->password = Hash::make($request->password);
        }
        if ($request->profileimage) {
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

        Mail::send('email.invite', array('request' => $request, 'adminname' => Auth::user()->name), function ($message) use ($request) {
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
        $data = slideshows::orderby('id', 'desc')->paginate(6);
        return view('admin.slideshows.all')->with(array('data' => $data));
    }
    public function createslideshow(Request $request)
    {
        $filesize = $request->file('video')->getSize();
        $create  = new slideshows;
        $create->name = $request->name;
        $create->category_id = $request->category_id;
        $create->url = Cmf::shorten_url($request->name);
        $create->short_description = $request->short_description;
        $create->video = Cmf::sendimagetodirectory($request->video);
        $create->filesize = $this->formatBytes($filesize);
        if ($request->image) {
            $create->image = Cmf::sendimagetodirectory($request->image);
        }
        $create->save();
        return redirect()->back()->with('message', 'Slide Show Uploaded Successfully');
    }
    public function updateslideshow(Request $request)
    {
        $create  = slideshows::find($request->id);
        $create->name = $request->name;
        $create->category_id = $request->category_id;
        $create->url = Cmf::shorten_url($request->name);
        $create->short_description = $request->short_description;
        if ($request->video) {
            $filesize = $request->file('video')->getSize();
            $create->video = Cmf::sendimagetodirectory($request->video);
            $create->filesize = $this->formatBytes($filesize);
        }
        if ($request->image) {
            $create->image = Cmf::sendimagetodirectory($request->image);
        }
        $create->save();
        return redirect()->back()->with('message', 'Slide Show Updated Successfully');
    }
    public function searchslideshow(Request $request)
    {
        $data = slideshows::Where('name', 'like', '%' . $request->keyword . '%')->paginate(100);
        return view('admin.slideshows.all')->with(array('data' => $data));
    }
    public function deleteslideshow(Request $request)
    {
        slideshows::where('id', $request->id)->delete();
        return redirect()->back()->with('message', 'Slide Show Deleted Successfully');
    }
    public function editslideshow($id)
    {
        $video = slideshows::find($id);
        $data = slideshows::orderby('id', 'desc')->whereNotIn('id', [$id])->paginate(6);
        return view('admin.slideshows.edit')->with(array('data' => $data, 'video' => $video));
    }


    public function allquizzes()
    {
        $data  = quizzes::orderby('id', 'desc')->paginate(8);
        return view('admin.quizzes.all')->with(array('data' => $data));
    }
    public function addnewquiz()
    {
        return view('admin.quizzes.add');
    }

    public function createquiz(Request $request)
    {
        $add = new quizzes;
        $add->name = $request->name;
        if ($request->image) {
            $add->image = Cmf::sendimagetodirectory($request->image);
        }
        // $add->duration = $request->duration;
        $add->short_description = $request->short_description;
        $add->url = Cmf::shorten_url($request->name);
        $add->status = 'In Active';
        $add->save();
        $url = url('admin/quizzes/addquestion') . '/' . $add->id;
        return Redirect::to($url);
    }

    public function updatequiz(Request $request)
    {
        $add = quizzes::find($request->id);
        $add->name = $request->name;
        if ($request->image) {
            $add->image = Cmf::sendimagetodirectory($request->image);
        }
        // $add->duration = $request->duration;
        $add->short_description = $request->short_description;
        $add->url = Cmf::shorten_url($request->name);
        $add->status = $request->status;
        $add->save();
        return redirect()->back()->with('message', 'Quiz Updated Successfully');
    }

    public function addquestion($id)
    {
        $data = quizzes::find($id);
        return view('admin.quizzes.addquestion')->with(array('data' => $data));
    }
    public function createquestion(Request $request)
    {
        if($request->question)
        {
            $add = new questions;
            $add->question = $request->question;
            $add->quiz_id = $request->quiz_id;
            $add->save();
            foreach ($request->option as $r) {
                $an = new answers;
                $an->question_id = $add->id;
                $an->answer = $r;
                $an->save();
            }
            $per = 0;
            foreach (answers::where('question_id', $add->id)->orderby('id', 'asc')->get() as $r) {
                $per++;

                if ($per == $request->answer) {
                    $add = questions::find($add->id);
                    $add->answer_id = $r->id;
                    $add->save();
                }
            }
        }

        if ($request->type == 'saveandanotherquestion') {
            $url = url('admin/quizzes/addquestion') . '/' . $request->quiz_id;
            return Redirect::to($url);
        }
        if ($request->type == 'saveandpublishquiz') {
            $user = User::all();
            $quiz = quizzes::where('id', $request->quiz_id)->first();
            foreach ($user as $r) {
                $noti = new user_notifications();
                $noti->user_id  = $r->id;
                $noti->url = url('quiz') . '/' . $quiz->url;
                $noti->notification = 'New Quiz Added';
                $noti->status = 'new';
                $noti->save();
            }
            $quiz = quizzes::find($request->quiz_id);
            $quiz->status = 'Active';
            $quiz->save();
            $url = url('admin/quizzes');
            return Redirect::to($url);
        }
    }

    public function deletequiz(Request $request)
    {
        $question = questions::where('quiz_id', $request->id)->get();
        foreach ($question as $r) {
            answers::where('question_id', $r->id)->delete();
        }
        questions::where('quiz_id', $request->id)->delete();
        userquizes::where('quiz_id', $request->id)->delete();
        quizzes::where('id', $request->id)->delete();
        return redirect()->back()->with('message', 'Quiz Deleted Successfully');
    }
    public function deletequestion(Request $request)
    {
        questions::where('id', $request->id)->delete();
        return redirect()->back()->with('message', 'Question Deleted Successfully');
    }
    public function viewquiz($id)
    {
        $data = quizzes::find($id);
        return view('admin.quizzes.viewquiz')->with(array('data' => $data));
    }
    public function editquestion($id)
    {
        $data = questions::find($id);
        return view('admin.quizzes.editquestion')->with(array('data' => $data));
    }
    public function removeoption($answerid , $questionid)
    {
        answers::where('id' , $answerid)->delete();
        $data = answers::where('question_id' , $questionid)->get();
        $question = questions::where('id' , $questionid)->first();
        foreach ($data as $a) {
            echo '<div class="row">
                <div class="col-xl-9">
                    <div class="form-group">
                        <div class="input-group">
                            <input id="option'.$a->id.'" name="option[]" value="'.$a->answer.'" type="text" class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6">
                            <div class="input-group-append">
                                <span id="savecheck'.$a->id.'" onclick="saveanswer('.$a->id.' , '.$questionid.')" class="btn'; if($a->answer){ echo ' btn-success '; }else{ echo ' btn-primary '; }  echo' " type="button"><i class="fa fa-check"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="d-flex justify-content-between">
                        <label class="checkbox checkbox-lg">
                            <input'; if($question->answer_id == $a->id){ echo " checked "; } echo' type="radio" value="'.$a->id.'" name="answer"/> <span></span> &nbsp
                            Answer
                        </label>
                        <div>
                            <span id="removebutton'.$a->id.'" onclick="removeoption('.$a->id.','.$questionid.')" class="btn btn-primary btn-sm">Remove</span>
                        </div>
                    </div>

                </div>
            </div>';
        }
    }
    public function addanswer($id)
    {
        $uestionid = $id;
        $an = new answers;
        $an->question_id = $id;
        $an->save();
        echo '<div class="row">
                <div class="col-xl-9">
                    <div class="form-group">
                        <div class="input-group">
                            <input id="option'.$an->id.'" name="option[]" value="'.$an->answer.'" type="text" class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6">
                            <div class="input-group-append">
                                <span id="savecheck'.$an->id.'" onclick="saveanswer('.$an->id.' , '.$id.')" class="btn'; if($an->answer){ echo ' btn-success '; }else{ echo ' btn-primary '; }  echo' " type="button"><i class="fa fa-check"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="d-flex justify-content-between">
                        <label class="checkbox checkbox-lg">
                            <input type="radio" value="'.$an->id.'" name="answer"/> <span></span> &nbsp
                            Answer
                        </label>
                        <div>
                            <span id="removebutton'.$an->id.'" onclick="removeoption('.$an->id.' , '.$id.')" class="btn btn-primary btn-sm">Remove</span>
                        </div>
                    </div>

                </div>
            </div>';
    }


    public function saveanswer($value , $answerid , $questionid)
    {
        $an = answers::find($answerid);
        $an->answer = $value;
        $an->save();

        $question = questions::where('id' , $questionid)->first();

        $data = answers::where('question_id' , $questionid)->get();
        foreach ($data as $a) {
            echo '<div class="row">
                <div class="col-xl-9">
                    <div class="form-group">
                        <div class="input-group">
                            <input id="option'.$a->id.'" name="option[]" value="'.$a->answer.'" type="text" class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6">
                            <div class="input-group-append">
                                <span id="savecheck'.$a->id.'" onclick="saveanswer('.$a->id.' , '.$questionid.')" class="btn'; if($a->answer){ echo ' btn-success '; }else{ echo ' btn-primary '; }  echo' " type="button"><i class="fa fa-check"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="d-flex justify-content-between">
                        <label class="checkbox checkbox-lg">
                            <input'; if($question->answer_id == $a->id){ echo " checked "; } echo' type="radio" value="'.$a->id.'" name="answer"/> <span></span> &nbsp
                            Answer
                        </label>
                        <div>
                            <span id="removebutton'.$a->id.'" onclick="removeoption('.$a->id.','.$questionid.')" class="btn btn-primary btn-sm">Remove</span>
                        </div>
                    </div>

                </div>
            </div>';
        }

    }

    public function editquestionstore(Request $request)
    {
        $add =  questions::find($request->question_id);
        $add->question = $request->question;
        $add->answer_id = $request->answer;
        $add->save();
        return redirect()->back()->with('message', "Question Updated Successfully");
    }

    public function deleteanswer($id)
    {
        answers::where('id', $id)->delete();
        return redirect()->back()->with('message', "Answer Deleted Successfully");
    }
    function multipledelete(Request $request){
        foreach($request->delteid as $r)
        {
            mywatchvideos::where('video_id' , $r)->delete();
            videos::where('id', $r)->delete();
        }
        return redirect()->back()->with('message', 'Video Deleted Successfully');
    }
    function multipledeleteSlide(Request $request){
        foreach($request->delteid as $r)
        {

            slideshows::where('id', $r)->delete();

        }
        return redirect()->back()->with('message', 'Slides Deleted Successfully');
    }
    function multipledeleteQuizzes(Request $request){

        foreach($request->delteid as $q)
        {
            $question = questions::where('quiz_id', $q)->get();
            foreach ($question as $r) {
                answers::where('question_id', $r->id)->delete();
            }
            questions::where('quiz_id', $q)->delete();
            userquizes::where('quiz_id', $q)->delete();
            quizzes::where('id', $q)->delete();
        }
        return redirect()->back()->with('message', 'QUIZZESS Deleted Successfully');
    }
    function editquiz($id)
    {
        $data = quizzes::find($id);
        return view('admin.quizzes.editquiz')->with(array('data' => $data));
    }
}
