<?php

namespace App\Http\Controllers;

use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\videos;
use App\Models\mywatchvideos;
use App\Models\video_categories;
use App\Models\slideshow_categories;
use App\Models\slideshows;
use App\Models\quizzes;
use App\Models\User;
use App\Models\questions;
use App\Models\answers;
use App\Models\userquizes;
use App\Models\userquizes_answers;
use App\Models\user_positions;
use App\Models\user_notifications;
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

    if(Auth::check())
    {
        if(Auth::user()->type == 'admin')
        {
            return redirect()->route('admin.dashboard');
        }else{
            $mywatchvideos = mywatchvideos::orderby('id', 'desc')->where('user_id', Auth::user()->id)->limit(4)->get();
            $quizzes = quizzes::orderby('id', 'desc')->where('status' , 'Active')->limit(4)->get();
            $total = userquizes::where('user_id', Auth::user()->id)->where('status', 'done')->sum('total');
            $score = userquizes::where('user_id', Auth::user()->id)->where('status', 'done')->sum('score');
            if ($score > 0) {
              $percentageofquizes = $score / $total;
            } else {
              $percentageofquizes = 0;
            }
            return view('frontend.user.dashboard')->with(array('mywatchvideos' => $mywatchvideos, 'quizzes' => $quizzes, 'percentageofquizes' => $percentageofquizes));
        }
        
    }else{
        return redirect()->route('login');  
    }
  }
  public function quizes()
  {
    $data = quizzes::orderby('id', 'desc')->where('status' , 'Active')->get();
    return view('frontend.user.quizes')->with(array('data' => $data));
  }
  public function profile()
  {
    return view('frontend.user.profile');
  }
  public function securitysettings()
  {
    return view('frontend.user.securitysettings');
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
  public function clicknotification($id)
  {
    $noti = user_notifications::find($id);
    $noti->status = 'old';
    $noti->save();
    return $noti->url;
  }
  public function quizdetail($id)
  {
    $data = quizzes::where('url', $id)->first();
    $check = userquizes::where('user_id', Auth::user()->id)->where('quiz_id', $data->id);

    if ($check->count() > 0) {
      return view('frontend.user.quizdetail')->with(array('data' => $data));
    } else {
      $newquiz = new userquizes;
      $newquiz->user_id = Auth::user()->id;
      $newquiz->quiz_id = $data->id;
      $newquiz->status = 'pending';
      $newquiz->score = 0;
      $newquiz->total = DB::table('questions')->where('quiz_id', $data->id)->count();
      $newquiz->save();
      foreach (DB::table('questions')->where('quiz_id', $data->id)->get() as $r) {
        $user_quiz = new userquizes_answers;
        $user_quiz->user_quiz_id = $newquiz->id;
        $user_quiz->question = $r->id;
        $user_quiz->save();
      }
      return view('frontend.user.quizdetail')->with(array('data' => $data));
    }
  }
  public function getuserquiz($id)
  {
    $get = userquizes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->first();
    $data = userquizes_answers::where('user_quiz_id', $get->id)->wherenull('answer')->first();
    $answercount = userquizes_answers::where('user_quiz_id', $get->id)->wherenotnull('answer')->count();
    $answercount = $answercount + 1;
    if ($data) {

      $countpercentage = $answercount / DB::table('questions')->where('quiz_id', $id)->count();
      $totalpercentage = $countpercentage * 100;

      echo '<div class="container">
                   <div class="row">
                     <div class="col-md-12">
                     <div class="pop-up-div">
                       <div class="row">
                         <div class="col-md-12 pop-up-logo">
                           <img src="' . url('public/assets/images/logo.png') . '" class="img-fluid">
                           <a href="' . url('') . '" class="cross-icon">
                             <i class="fa fa-times" aria-hidden="true"></i>
                           </a>
                         </div>      
                       </div>
                       <div class="row mb-4">
                         <div class="col-md-12">
                           <div class="my-bar">
                           <div class="main-outer">
                           <div class="progress-bar">
                             <div class="progress-container">
                              <div aria-valuenow="70"aria-valuemin="0" aria-valuemax="100" style="width:' . $totalpercentage . '% !important" class="progress-bar"></div>
                          </div>
                           </div>
                         </div>
                         <p>' . $answercount . '/' . DB::table('questions')->where('quiz_id', $id)->count() . '</p>
                         </div>
                         </div>
                       </div>
                     </div>
                   </div>
                   </div>
                   <div class="row">
                     <div class="col-md-12">
                      <div id="showquiz">
                            <div class="pop-up-card">
                                <p>Choose Single Options</p>
                                <h2>' . questions::where('id', $data->question)->first()->question . '</h2>
                                <div class="row">';
      foreach (DB::table('answers')->where('question_id', $data->question)->get() as $a) {
        echo '<div class="col-md-6 col-12 ">
                                             <div onclick="selectoption(' . $a->id . ',' . $data->question . ')" id="selectoption' . $a->id . '" class="select-btn">
                                                <input type="radio" class="form-control">
                                                <span>' . $a->answer . '</span>
                                             </div>
                                           </div>';
      }
      echo '</div>
                                <div class="validityerror text-danger"></div>
                            </div>
                      </div>
                       <input type="hidden" id="slectedoption">
                       <input type="hidden" id="question">
                       <div class="main-btn-outer">
                         <div class="left-btns-div">
                           <a style="display: none;" href="javascript:void(0)" class="back-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                          <path d="M9.56994 18.8201C9.37994 18.8201 9.18994 18.7501 9.03994 18.6001L2.96994 12.5301C2.67994 12.2401 2.67994 11.7601 2.96994 11.4701L9.03994 5.40012C9.32994 5.11012 9.80994 5.11012 10.0999 5.40012C10.3899 5.69012 10.3899 6.17012 10.0999 6.46012L4.55994 12.0001L10.0999 17.5401C10.3899 17.8301 10.3899 18.3101 10.0999 18.6001C9.95994 18.7501 9.75994 18.8201 9.56994 18.8201Z" fill="url(#paint0_linear_82_46)"/>
                          <path d="M20.4999 12.75H3.66992C3.25992 12.75 2.91992 12.41 2.91992 12C2.91992 11.59 3.25992 11.25 3.66992 11.25H20.4999C20.9099 11.25 21.2499 11.59 21.2499 12C21.2499 12.41 20.9099 12.75 20.4999 12.75Z" fill="url(#paint1_linear_82_46)"/>
                          <defs>
                            <linearGradient id="paint0_linear_82_46" x1="6.53494" y1="5.18262" x2="6.53494" y2="18.8201" gradientUnits="userSpaceOnUse">
                              <stop stop-color="#24272C"/>
                              <stop offset="1" stop-color="#202326"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear_82_46" x1="12.0849" y1="11.25" x2="12.0849" y2="12.75" gradientUnits="userSpaceOnUse">
                              <stop stop-color="#24272C"/>
                              <stop offset="1" stop-color="#202326"/>
                            </linearGradient>
                          </defs>
                          </svg> Back</a>
                          </div>
                          <div class="right-btns-div">
                            <a onclick="nextbutton()" href="javascript:void(0)"><span>Next</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M14.4301 18.8201C14.2401 18.8201 14.0501 18.7501 13.9001 18.6001C13.6101 18.3101 13.6101 17.8301 13.9001 17.5401L19.4401 12.0001L13.9001 6.46012C13.6101 6.17012 13.6101 5.69012 13.9001 5.40012C14.1901 5.11012 14.6701 5.11012 14.9601 5.40012L21.0301 11.4701C21.3201 11.7601 21.3201 12.2401 21.0301 12.5301L14.9601 18.6001C14.8101 18.7501 14.6201 18.8201 14.4301 18.8201Z" fill="white"/>
                            <path d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z" fill="white"/>
                          </svg></a>
                          </div>
                       </div>
                     </div>
                   </div>
                 </div>';
    } else {
      userquizes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->update(array('status' => 'done'));
      $get = userquizes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->first();
      $result = userquizes_answers::select('answer')->where('user_quiz_id', $get->id)->get();
      $correct = questions::select('answer_id')->where('quiz_id', $id)->get();
      $i = 0;
      foreach ($correct as $c) {
        foreach ($result as $r) {
          if ($c->answer_id == $r->answer) {
            $i++;
          }
        }
      }
      $correctanswer =  $i;
      userquizes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->update(array('score' => $correctanswer));
      $incorrectanswer = DB::table('questions')->where('quiz_id', $id)->count() - $i;
      $getpercentage = $i / DB::table('questions')->where('quiz_id', $id)->count();
      $fullpercentage = $getpercentage * 100;


      $checkposition_data = user_positions::where('user_id' , Auth::user()->id)->count();

      if($checkposition_data > 0)
      {
          $totalmarks =  userquizes::where('user_id', Auth::user()->id)->sum('total');
          $obtainedmarks = userquizes::where('user_id', Auth::user()->id)->sum('score');
          $percentage = $obtainedmarks/$totalmarks;
          $percentage = $percentage*100;
          $positionid = user_positions::where('user_id' , Auth::user()->id)->first();
          $positiondata = user_positions::find($positionid->id);
          $positiondata->percentage = round($percentage , 0);
          $positiondata->save();

          $updatenull = user_positions::all();

          foreach ($updatenull as $r) {
              $positiondata = user_positions::find($r->id);
              $positiondata->position = '';
              $positiondata->save();
          }

          $getuser_positions = user_positions::orderby('percentage' , 'desc')->limit(3)->get();      
          $per = 0;
          foreach ($getuser_positions as $r) {
              $per++;
              if($per == 1)
              {
                $positiondata = user_positions::find($r->id);
                $positiondata->position = 'first';
                $positiondata->save();
              }
              if($per == 2)
              {
                $positiondata = user_positions::find($r->id);
                $positiondata->position = 'second';
                $positiondata->save();
              }
              if($per == 3)
              {
                $positiondata = user_positions::find($r->id);
                $positiondata->position = 'third';
                $positiondata->save();
              }
          }

      }else{
        $totalmarks =  userquizes::where('user_id', Auth::user()->id)->sum('total');
        $obtainedmarks = userquizes::where('user_id', Auth::user()->id)->sum('score');
        $percentage = $obtainedmarks/$totalmarks;
        $percentage = $percentage*100;
        $positiondata = new user_positions;
        $positiondata->user_id = Auth::user()->id;
        $positiondata->percentage = round($percentage , 0);
        $positiondata->save();

        $updatenull = user_positions::all();

          foreach ($updatenull as $r) {
              $positiondata = user_positions::find($r->id);
              $positiondata->position = '';
              $positiondata->save();
          }

        $getuser_positions = user_positions::orderby('percentage' , 'desc')->limit(3)->get();
        
        $per = 0;
        foreach ($getuser_positions as $r) {
            $per++;
            if($per == 1)
            {
              $positiondata = user_positions::find($r->id);
              $positiondata->position = 'first';
              $positiondata->save();
            }
            if($per == 2)
            {
              $positiondata = user_positions::find($r->id);
              $positiondata->position = 'second';
              $positiondata->save();
            }
            if($per == 3)
            {
              $positiondata = user_positions::find($r->id);
              $positiondata->position = 'third';
              $positiondata->save();
            }
        }


      }



      echo '<div class="container">
                   <div class="row">
                     <div class="col-md-12">
                     <div class="pop-up-div">
                       <div class="row">
                         <div class="col-md-12 pop-up-logo">
                           <img src="' . url('public/assets/images/logo.png') . '" class="img-fluid">
                           <a href="' . url('') . '" class="cross-icon">
                             <i class="fa fa-times" aria-hidden="true"></i>
                           </a>
                         </div>      
                       </div>
                     </div>
                   </div>
                   </div>
                   <div class="row">
                     <div class="col-md-12">
                      <div id="showquiz" class="mt-5">
                            <div class="pop-up-card pop-card-two" id="step2">
                                <div role="progressbar" aria-valuenow="' . round($fullpercentage, 0) . '" aria-valuemin="0" aria-valuemax="100" style="--value:' . round($fullpercentage, 0) . '"></div>
                                 <p>'; if(round($fullpercentage, 0) > 50) { echo ' Congratulations !'; }else{ echo ' Better Luck Next Time !'; } echo'</p>
                                 <h2>You have attempted ' . DB::table('questions')->where('quiz_id', $id)->count() . ' questions out of ' . DB::table('questions')->where('quiz_id', $id)->count() . '</h2>
                                 <div class="main-outer-result">
                                   <div class="result-inner">
                                     <div class="result-card">
                                     <h3>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                      <path d="M13.5002 25.6051C12.2739 25.6051 11.0589 25.2451 10.1027 24.5364L5.26519 20.9251C3.98269 19.9689 2.98145 17.9664 2.98145 16.3801V8.01012C2.98145 6.27762 4.2527 4.43262 5.88395 3.82512L11.4977 1.72137C12.6114 1.30512 14.3664 1.30512 15.4802 1.72137L21.0939 3.82512C22.7252 4.43262 23.9964 6.27762 23.9964 8.01012V16.3689C23.9964 17.9664 22.9952 19.9576 21.7127 20.9139L16.8752 24.5251C15.9414 25.2451 14.7264 25.6051 13.5002 25.6051ZM12.0939 3.30762L6.4802 5.41137C5.52395 5.77137 4.6802 6.98637 4.6802 8.02137V16.3801C4.6802 17.4489 5.43395 18.9451 6.2777 19.5751L11.1152 23.1864C12.4089 24.1539 14.5914 24.1539 15.8964 23.1864L20.7339 19.5751C21.5889 18.9339 22.3314 17.4489 22.3314 16.3801V8.01012C22.3314 6.98637 21.4877 5.77137 20.5314 5.40012L14.9177 3.29637C14.1527 3.02637 12.8477 3.02637 12.0939 3.30762Z" fill="#292D32"/>
                                      <path d="M11.9925 16.0085C11.7788 16.0085 11.565 15.9298 11.3963 15.761L9.58502 13.9498C9.25877 13.6235 9.25877 13.0835 9.58502 12.7573C9.91127 12.431 10.4513 12.431 10.7775 12.7573L11.9925 13.9723L16.2338 9.73102C16.56 9.40477 17.1 9.40477 17.4263 9.73102C17.7525 10.0573 17.7525 10.5973 17.4263 10.9235L12.5888 15.761C12.42 15.9298 12.2063 16.0085 11.9925 16.0085Z" fill="#292D32"/>
                                    </svg> 
                                    <span>' . $i . '</span></h3>
                                    <p>Correct Answers</p>
                                   </div>
                                   </div>
                                   <div class="result-inner">
                                     <div class="result-card">
                                     <h3><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                      <path d="M13.5002 25.6051C12.2739 25.6051 11.0589 25.2451 10.1027 24.5364L5.26519 20.9251C3.98269 19.9689 2.98145 17.9664 2.98145 16.3801V8.01012C2.98145 6.27762 4.2527 4.43262 5.88395 3.82512L11.4977 1.72137C12.6114 1.30512 14.3664 1.30512 15.4802 1.72137L21.0939 3.82512C22.7252 4.43262 23.9964 6.27762 23.9964 8.01012V16.3689C23.9964 17.9664 22.9952 19.9576 21.7127 20.9139L16.8752 24.5251C15.9414 25.2451 14.7264 25.6051 13.5002 25.6051ZM12.0939 3.30762L6.4802 5.41137C5.52395 5.77137 4.6802 6.98637 4.6802 8.02137V16.3801C4.6802 17.4489 5.43395 18.9451 6.2777 19.5751L11.1152 23.1864C12.4089 24.1539 14.5914 24.1539 15.8964 23.1864L20.7339 19.5751C21.5889 18.9339 22.3314 17.4489 22.3314 16.3801V8.01012C22.3314 6.98637 21.4877 5.77137 20.5314 5.40012L14.9177 3.29637C14.1527 3.02637 12.8477 3.02637 12.0939 3.30762Z" fill="#292D32"/>
                                      <path d="M11.9925 16.0085C11.7788 16.0085 11.565 15.9298 11.3963 15.761L9.58502 13.9498C9.25877 13.6235 9.25877 13.0835 9.58502 12.7573C9.91127 12.431 10.4513 12.431 10.7775 12.7573L11.9925 13.9723L16.2338 9.73102C16.56 9.40477 17.1 9.40477 17.4263 9.73102C17.7525 10.0573 17.7525 10.5973 17.4263 10.9235L12.5888 15.761C12.42 15.9298 12.2063 16.0085 11.9925 16.0085Z" fill="#292D32"/>
                                    </svg> <span>' . $incorrectanswer . '</span></h3>
                                    <p>In Correct Answers</p>
                                   </div>
                                   </div>
                                 </div>
                               </div>
                      </div>
                     </div>
                   </div>
                 </div>';
    }
  }
  public function savequiz($quiz, $value, $question)
  {
    $get = userquizes::where('user_id', Auth::user()->id)->where('quiz_id', $quiz)->first();
    $data = userquizes_answers::where('user_quiz_id', $get->id)->where('question', $question)->update(array('answer' => $value));
    return $this->getuserquiz($quiz);
  }
  public function slideshows()
  {
    $data = slideshows::orderby('id', 'desc')->paginate(8);
    return view('frontend.slideshows.all')->with(array('data' => $data));
  }
  public function slideshowdetail($id)
  {
    $data = slideshows::where('url', $id)->first();
    $relatedslideshow = slideshows::where('category_id', $data->category_id)->whereNotIn('id', [$data->id])->limit(4)->get();
    return view('frontend.slideshows.detail')->with(array('data' => $data, 'relatedslideshow' => $relatedslideshow));
  }
  public function videos()
  {
    $data = videos::orderby('id', 'desc')->paginate(8);
    return view('frontend.videos.all')->with(array('data' => $data));
  }
  public function categorydetail($id)
  {
    $category = video_categories::where('url', $id)->first();
    $data = videos::orderby('id', 'desc')->where('category_id', $category->id)->paginate(8);
    return view('frontend.videos.categorydetail')->with(array('data' => $data, 'category' => $category));
  }
  public function slidecategory($id)
  {
    $category = slideshow_categories::where('url', $id)->first();
    $data = slideshows::orderby('id', 'desc')->where('category_id', $category->id)->paginate(8);
    return view('frontend.slideshows.categorydetail')->with(array('data' => $data, 'category' => $category));
  }
  public function videodetail($id)
  {
    $data = videos::where('url', $id)->first();
    $check = mywatchvideos::where('user_id', Auth::user()->id)->where('video_id', $data->id)->count();
    if ($check > 0) {
      mywatchvideos::where('user_id', Auth::user()->id)->where('video_id', $data->id)->delete();
      $newdata = new mywatchvideos;
      $newdata->user_id = Auth::user()->id;
      $newdata->video_id = $data->id;
      $newdata->save();
    } else {
      $newdata = new mywatchvideos;
      $newdata->user_id = Auth::user()->id;
      $newdata->video_id = $data->id;
      $newdata->save();
    }
    $relatedvideos = videos::where('category_id', $data->category_id)->whereNotIn('id', [$data->id])->limit(4)->get();
    return view('frontend.videos.detail')->with(array('data' => $data, 'relatedvideos' => $relatedvideos));
  }

  public function search()
  {
    if (request('query')) {
       $video = videos::where('name', 'like', '%' . request('query') . '%')->get();
       $slideshow = slideshows::where('name', 'like', '%' . request('query') . '%')->get();
       $quizes = quizzes::where('name', 'like', '%' . request('query') . '%')->get();
    } else{
      $data = videos::all();
    }
    return view('frontend.search.search')->with(array('video' => $video,'slideshow' => $slideshow ,'quizes' => $quizes));
  }
}
