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
use App\Models\questions;
use App\Models\answers;
use App\Models\userquizes;
use App\Models\userquizes_answers;
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
        $quizzes = quizzes::orderby('id' , 'desc')->limit(4)->get();
        $total = userquizes::where('user_id' , Auth::user()->id)->where('status' , 'done')->sum('total');
        $score = userquizes::where('user_id' , Auth::user()->id)->where('status' , 'done')->sum('score');
        $percentageofquizes = $score/$total;
        return view('frontend.user.dashboard')->with(array('mywatchvideos' =>$mywatchvideos,'quizzes' =>$quizzes,'percentageofquizes' =>$percentageofquizes));
    }
    public function quizdetail($id)
    {
        $data = quizzes::where('url' , $id)->first();
        $check = userquizes::where('user_id' , Auth::user()->id)->where('quiz_id' , $data->id);

        if($check->count() > 0)
        {
            return view('frontend.user.quizdetail')->with(array('data' =>$data));
        }else{
            $newquiz = new userquizes;
            $newquiz->user_id = Auth::user()->id;
            $newquiz->quiz_id = $data->id;
            $newquiz->status = 'pending';
            $newquiz->score = 0;
            $newquiz->total = DB::table('questions')->where('quiz_id' , $data->id)->count();
            $newquiz->save();
            foreach (DB::table('questions')->where('quiz_id' , $data->id)->get() as $r) {
                $user_quiz = new userquizes_answers;
                $user_quiz->user_quiz_id = $newquiz->id;
                $user_quiz->question = $r->id;
                $user_quiz->save();
            }
            return view('frontend.user.quizdetail')->with(array('data' =>$data)); 
        }

        
    }
    public function getuserquiz($id)
    {
        $get = userquizes::where('user_id' , Auth::user()->id)->where('quiz_id' , $id)->first();
        $data = userquizes_answers::where('user_quiz_id' , $get->id)->wherenull('answer')->first();
        if($data)
        {
            echo '<div class="pop-up-card">
             <p>Choose Single Options</p>
             <h2>'.questions::where('id',$data->question)->first()->question.'</h2>
             <div class="row">';
              foreach(DB::table('answers')->where('question_id' , $data->question)->get() as $a)
              {
                echo '<div class="col-md-6 col-12 ">
                         <div onclick="selectoption('.$a->id.','.$data->question.')" id="selectoption'.$a->id.'" class="select-btn">
                            <input type="radio" class="form-control">
                            <span>'.$a->answer.'</span>
                         </div>
                       </div>';
              }
             echo '</div>
           </div>';
        }else{
            userquizes::where('user_id' , Auth::user()->id)->where('quiz_id' , $id)->update(array('status' =>'done'));
            $get = userquizes::where('user_id' , Auth::user()->id)->where('quiz_id' , $id)->first();
            $result = userquizes_answers::select('answer')->where('user_quiz_id' , $get->id)->get();
            $correct = questions::select('answer_id')->where('quiz_id' , $id)->get();
            $i=0;
            foreach ($correct as $c) {
                foreach ($result as $r) {
                    if($c->answer_id == $r->answer)
                    {
                        $i++;
                    }
                }
            }
            $correctanswer =  $i;

            userquizes::where('user_id' , Auth::user()->id)->where('quiz_id' , $id)->update(array('score' =>$correctanswer));


            $incorrectanswer = DB::table('questions')->where('quiz_id' , $id)->count() - $i;
            $getpercentage = $i / DB::table('questions')->where('quiz_id' , $id)->count(); 
            $fullpercentage = $getpercentage*100;
            echo '<div class="pop-up-card pop-card-two" id="step2">
        <div role="progressbar" aria-valuenow="'.round($fullpercentage, 0).'" aria-valuemin="0" aria-valuemax="100" style="--value:'.round($fullpercentage, 0).'"></div>
         <p>Congratulations !</p>
         <h2>You have attempted '.DB::table('questions')->where('quiz_id' , $id)->count().' questions out of '.DB::table('questions')->where('quiz_id' , $id)->count().'</h2>
         <div class="main-outer-result">
           <div class="result-inner">
             <div class="result-card">
             <h3>
              <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
              <path d="M13.5002 25.6051C12.2739 25.6051 11.0589 25.2451 10.1027 24.5364L5.26519 20.9251C3.98269 19.9689 2.98145 17.9664 2.98145 16.3801V8.01012C2.98145 6.27762 4.2527 4.43262 5.88395 3.82512L11.4977 1.72137C12.6114 1.30512 14.3664 1.30512 15.4802 1.72137L21.0939 3.82512C22.7252 4.43262 23.9964 6.27762 23.9964 8.01012V16.3689C23.9964 17.9664 22.9952 19.9576 21.7127 20.9139L16.8752 24.5251C15.9414 25.2451 14.7264 25.6051 13.5002 25.6051ZM12.0939 3.30762L6.4802 5.41137C5.52395 5.77137 4.6802 6.98637 4.6802 8.02137V16.3801C4.6802 17.4489 5.43395 18.9451 6.2777 19.5751L11.1152 23.1864C12.4089 24.1539 14.5914 24.1539 15.8964 23.1864L20.7339 19.5751C21.5889 18.9339 22.3314 17.4489 22.3314 16.3801V8.01012C22.3314 6.98637 21.4877 5.77137 20.5314 5.40012L14.9177 3.29637C14.1527 3.02637 12.8477 3.02637 12.0939 3.30762Z" fill="#292D32"/>
              <path d="M11.9925 16.0085C11.7788 16.0085 11.565 15.9298 11.3963 15.761L9.58502 13.9498C9.25877 13.6235 9.25877 13.0835 9.58502 12.7573C9.91127 12.431 10.4513 12.431 10.7775 12.7573L11.9925 13.9723L16.2338 9.73102C16.56 9.40477 17.1 9.40477 17.4263 9.73102C17.7525 10.0573 17.7525 10.5973 17.4263 10.9235L12.5888 15.761C12.42 15.9298 12.2063 16.0085 11.9925 16.0085Z" fill="#292D32"/>
            </svg> 
            <span>'.$i.'</span></h3>
            <p>Correct Answers</p>
           </div>
           </div>
           <div class="result-inner">
             <div class="result-card">
             <h3><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
              <path d="M13.5002 25.6051C12.2739 25.6051 11.0589 25.2451 10.1027 24.5364L5.26519 20.9251C3.98269 19.9689 2.98145 17.9664 2.98145 16.3801V8.01012C2.98145 6.27762 4.2527 4.43262 5.88395 3.82512L11.4977 1.72137C12.6114 1.30512 14.3664 1.30512 15.4802 1.72137L21.0939 3.82512C22.7252 4.43262 23.9964 6.27762 23.9964 8.01012V16.3689C23.9964 17.9664 22.9952 19.9576 21.7127 20.9139L16.8752 24.5251C15.9414 25.2451 14.7264 25.6051 13.5002 25.6051ZM12.0939 3.30762L6.4802 5.41137C5.52395 5.77137 4.6802 6.98637 4.6802 8.02137V16.3801C4.6802 17.4489 5.43395 18.9451 6.2777 19.5751L11.1152 23.1864C12.4089 24.1539 14.5914 24.1539 15.8964 23.1864L20.7339 19.5751C21.5889 18.9339 22.3314 17.4489 22.3314 16.3801V8.01012C22.3314 6.98637 21.4877 5.77137 20.5314 5.40012L14.9177 3.29637C14.1527 3.02637 12.8477 3.02637 12.0939 3.30762Z" fill="#292D32"/>
              <path d="M11.9925 16.0085C11.7788 16.0085 11.565 15.9298 11.3963 15.761L9.58502 13.9498C9.25877 13.6235 9.25877 13.0835 9.58502 12.7573C9.91127 12.431 10.4513 12.431 10.7775 12.7573L11.9925 13.9723L16.2338 9.73102C16.56 9.40477 17.1 9.40477 17.4263 9.73102C17.7525 10.0573 17.7525 10.5973 17.4263 10.9235L12.5888 15.761C12.42 15.9298 12.2063 16.0085 11.9925 16.0085Z" fill="#292D32"/>
            </svg> <span>'.$incorrectanswer.'</span></h3>
            <p>In Correct Answers</p>
           </div>
           </div>
         </div>
       </div>';
        }

        
    }
    public function savequiz($quiz , $value , $question)
    {
        $get = userquizes::where('user_id' , Auth::user()->id)->where('quiz_id' , $quiz)->first();
        $data = userquizes_answers::where('user_quiz_id' , $get->id)->where('question' , $question)->update(array('answer' =>$value));
        return $this->getuserquiz($quiz);
    }
    public function slideshows()
    {
        $data = slideshows::orderby('id' , 'desc')->paginate(8);
        return view('frontend.slideshows.all')->with(array('data' =>$data));
    }
    public function slideshowdetail($id)
    {
        $data = slideshows::where('url' , $id)->first();
        $relatedslideshow = slideshows::where('category_id' , $data->category_id)->limit(4)->get();
        return view('frontend.slideshows.detail')->with(array('data' =>$data,'relatedslideshow' =>$relatedslideshow));
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
    public function slidecategory($id)
    {
        $category = slideshow_categories::where('url' , $id)->first();
        $data = slideshows::orderby('id' , 'desc')->where('category_id' , $category->id)->paginate(8);
        return view('frontend.slideshows.categorydetail')->with(array('data' =>$data,'category' =>$category));
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
        $relatedvideos = videos::where('category_id' , $data->category_id)->limit(4)->get();
        return view('frontend.videos.detail')->with(array('data' =>$data,'relatedvideos' =>$relatedvideos));
    }
}
