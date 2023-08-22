@extends('frontend.layouts.main')
@section('tittle')
<title>Dashboard</title>
@endsection
@section('content')
<section class="dashboard-sec">
 <div class="container">
   <div class="main-outer mb-4">
     <div class="morning-left">
       <h2>{{ Cmf::gettimeforday() }},</h2>
       <p>{{ Auth::user()->name }}</p>
     </div>
     <div class="morning-right">
       <div class="sun-media">
         <img src="{{ url('public/assets/images/sun.png') }}">
       </div>
     </div>
   </div>
   <div class="row">
     <div class="col-md-4 col-12">
       <div class="watch-video-card">
         <h3>Watched Videos</h3>
         <p></p>
         @foreach($mywatchvideos as $r)
         @php
          $video = DB::table('videos')->where('id' , $r->video_id)->first();
         @endphp
         <div class="watch-video-outer">
           <div class="video-left">
             <div class="video-img">
              @if($video->image)
              <img src="{{ url('public/images') }}/{{ $video->image }}">
              @else
              <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930">
              @endif
               
             </div>
           </div>
           <div class="video-right">
             <h2><a href="{{ url('video') }}/{{ $video->url }}">{{ $video->name }}</a></h2>
             <p>{{ DB::table('video_categories')->where('id' , $video->category_id)->first()->name }}</p>
             @if($video->duration)
             <span><i class="fa fa-clock-o" aria-hidden="true"></i> {{$video->duration}} Sec</span>
             @endif
           </div>
         </div>
         @endforeach
       </div>
     </div>
     <div class="col-md-8 col-12">
      <div class="row">
        <div class="col-md-6 col-12">
          <div class="left-chart">
            <div class="main-outer">
              <div class="left-chart-cntent">
                <p>Current Scoring</p>
                <h2>90%</h2>
                <span>10% <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                  <path d="M10.5408 6.01984C10.4299 6.01984 10.3191 5.97901 10.2316 5.89151L6.99995 2.65984L3.76828 5.89151C3.59911 6.06068 3.31911 6.06068 3.14995 5.89151C2.98078 5.72234 2.98078 5.44234 3.14995 5.27318L6.69078 1.73234C6.85995 1.56318 7.13995 1.56318 7.30911 1.73234L10.8499 5.27318C11.0191 5.44234 11.0191 5.72234 10.8499 5.89151C10.7683 5.97901 10.6516 6.01984 10.5408 6.01984Z" fill="#292D32"/>
                  <path d="M7 12.3956C6.76083 12.3956 6.5625 12.1973 6.5625 11.9581V2.14062C6.5625 1.90146 6.76083 1.70312 7 1.70312C7.23917 1.70312 7.4375 1.90146 7.4375 2.14062V11.9581C7.4375 12.1973 7.23917 12.3956 7 12.3956Z" fill="#292D32"/>
                </svg></span>
              </div>
              <div class="left-chart-media">
                <canvas id="columnChart"></canvas>
                <!-- <div id="chartContainer"></div> -->
                <!-- <img src="assets/images/line-chart.png"> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="left-chart">
            <div class="main-outer">
              <div class="left-chart-cntent">
                <p>Your Quizzes</p>
                <h2>90%</h2>
                <span>10% <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                  <path d="M10.5408 6.01984C10.4299 6.01984 10.3191 5.97901 10.2316 5.89151L6.99995 2.65984L3.76828 5.89151C3.59911 6.06068 3.31911 6.06068 3.14995 5.89151C2.98078 5.72234 2.98078 5.44234 3.14995 5.27318L6.69078 1.73234C6.85995 1.56318 7.13995 1.56318 7.30911 1.73234L10.8499 5.27318C11.0191 5.44234 11.0191 5.72234 10.8499 5.89151C10.7683 5.97901 10.6516 6.01984 10.5408 6.01984Z" fill="#292D32"/>
                  <path d="M7 12.3956C6.76083 12.3956 6.5625 12.1973 6.5625 11.9581V2.14062C6.5625 1.90146 6.76083 1.70312 7 1.70312C7.23917 1.70312 7.4375 1.90146 7.4375 2.14062V11.9581C7.4375 12.1973 7.23917 12.3956 7 12.3956Z" fill="#292D32"/>
                </svg></span>
              </div>
              <div class="left-chart-media">
                 <canvas id="chartId" aria-label="chart"></canvas>
                <!-- <img src="assets/images/line-chart.png"> -->
              </div>
            </div>
          </div>
        </div>           
      </div>
      <div class="row r-mar">
        <div class="col-md-7 col-12">
          <div class="latest-quiz-card">
           <h2>Latest Quizzes</h2>
           <p>Lorem ipsum dummy text</p>
           <div class="main-outer quiz-outer">
             <div class="quiz-left">
               <div class="main-outer">
                 <div class="quiz-left-inner">
                   <div class="quiz-inner-img">
                    <div class="quiz-media">
                       <img src="assets/images/quiz-1.png">
                    </div>
                   </div>
                 </div>
                 <div class="quiz-right-inner">
                   <h2><a href="">World Capitals Challenge</a></h2>
                   <p>12 Questions <span><i class="fa fa-clock-o" aria-hidden="true"></i> 30 min</span></p>
                 </div>
               </div>
             </div>
             <div class="quiz-btn">
               <h5 class="my-popup">Take Quiz</h5>
             </div>
           </div>
           <div class="main-outer quiz-outer">
             <div class="quiz-left">
               <div class="main-outer">
                 <div class="quiz-left-inner">
                   <div class="quiz-inner-img">
                    <div class="quiz-media">
                       <img src="assets/images/quiz-1.png">
                    </div>
                   </div>
                 </div>
                 <div class="quiz-right-inner">
                   <h2><a href="">World Capitals Challenge</a></h2>
                   <p>12 Questions <span><i class="fa fa-clock-o" aria-hidden="true"></i> 30 min</span></p>
                 </div>
               </div>
             </div>
             <div class="quiz-btn">
               <h5 class="my-popup">Take Quiz</h5>
             </div>
           </div>
           <div class="main-outer quiz-outer">
             <div class="quiz-left">
               <div class="main-outer">
                 <div class="quiz-left-inner">
                   <div class="quiz-inner-img">
                    <div class="quiz-media">
                       <img src="assets/images/quiz-1.png">
                    </div>
                   </div>
                 </div>
                 <div class="quiz-right-inner">
                   <h2><a href="">World Capitals Challenge</a></h2>
                   <p>12 Questions <span><i class="fa fa-clock-o" aria-hidden="true"></i> 30 min</span></p>
                 </div>
               </div>
             </div>
             <div class="quiz-btn">
               <h5 class="my-popup">Take Quiz</h5>
             </div>
           </div>
           <div class="main-outer quiz-outer">
             <div class="quiz-left">
               <div class="main-outer">
                 <div class="quiz-left-inner">
                   <div class="quiz-inner-img">
                    <div class="quiz-media">
                       <img src="assets/images/quiz-1.png">
                    </div>
                   </div>
                 </div>
                 <div class="quiz-right-inner">
                   <h2><a href="">World Capitals Challenge</a></h2>
                   <p>12 Questions <span><i class="fa fa-clock-o" aria-hidden="true"></i> 30 min</span></p>
                 </div>
               </div>
             </div>
             <div class="quiz-btn">
               <h5 class="my-popup">Take Quiz</h5>
             </div>
           </div>
          </div>
        </div>
        <div class="col-md-5 col-12">
          <div class="position-card">
            <div class="main-outer">
              <div class="sec-postion firt-position">
                <div class="sec-postion-media">
                  <img src="assets/images/position.png">
                  <h6>Jhon</h6>
                </div>
                <div >
                  <div class="position-number"><h2>2nd</h2></div>
                </div>
              </div>
              <div class="sec-postion two-position">
                <div class="sec-postion-media">
                  <img src="assets/images/position.png">
                  <h6>Jhon</h6>
                </div>
                <div >
                  <div class="position-number"><h2>1st</h2></div>
                </div>
              </div>
              <div class="sec-postion three-position">
                <div class="sec-postion-media">
                  <img src="assets/images/position.png">
                  <h6>Jhon</h6>
                </div>
                <div >
                  <div class="position-number"><h2>3nd</h2></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="main-outer postion-user-bod">
                <div class="left-contents">
                  <div class="left-contents-inner">
                    <div class="postion-user-media">
                      <img src="assets/images/position-user.png">
                    </div>
                    <div class="position-user-details">
                      <h2>Ricky Hunt</h2>
                      <p>90%</p>
                    </div>
                  </div>
                </div>
                <div class="right-contents">
                  <h2>4th</h2>
                </div>
              </div>
              <div class="main-outer postion-user-bod">
                <div class="left-contents">
                  <div class="left-contents-inner">
                    <div class="postion-user-media">
                      <img src="assets/images/position-user.png">
                    </div>
                    <div class="position-user-details">
                      <h2>Ricky Hunt</h2>
                      <p>90%</p>
                    </div>
                  </div>
                </div>
                <div class="right-contents">
                  <h2>4th</h2>
                </div>
              </div>
              <div class="main-outer postion-user-bod">
                <div class="left-contents">
                  <div class="left-contents-inner">
                    <div class="postion-user-media">
                      <img src="assets/images/position-user.png">
                    </div>
                    <div class="position-user-details">
                      <h2>Ricky Hunt</h2>
                      <p>90%</p>
                    </div>
                  </div>
                </div>
                <div class="right-contents">
                  <h2>4th</h2>
                </div>
              </div>
              <div class="main-outer postion-user-bod">
                <div class="left-contents">
                  <div class="left-contents-inner">
                    <div class="postion-user-media">
                      <img src="assets/images/position-user.png">
                    </div>
                    <div class="position-user-details">
                      <h2>Ricky Hunt</h2>
                      <p>90%</p>
                    </div>
                  </div>
                </div>
                <div class="right-contents">
                  <h2>4th</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
   </div>
 </div>
</section>
<section class="pop-up-sec">
 <div class="container">
   <div class="row">
     <div class="col-md-12">
     <div class="pop-up-div">
       <div class="row">
         <div class="col-md-12 pop-up-logo">
           <img src="assets/images/logo.png" class="img-fluid">
           <div class="cross-icon">
             <i class="fa fa-times" aria-hidden="true"></i>
           </div>
         </div>      
       </div>
       <div class="row mb-4">
         <div class="col-md-12">
           
           <div class="my-bar">
           <div class="main-outer">
           <div class="progress-bar">
             <div class="progress-container">
              <div class="progress-bar"></div>
          </div>
           </div>
         </div>
         <p>10/15</p>
         </div>
         </div>
       </div>
     </div>
   </div>
   </div>
   <div class="row">
     <div class="col-md-12">
       <div class="pop-up-card" id="step1">
         <p>Choose Single Options</p>
         <h2>Selected the areas you would like to work on?</h2>
         <div class="row">
           <div class="col-md-6 col-12 ">
             <div class="select-btn active">
               <a href="">
            <input type="radio" class="form-control">
            <span> 5 Senses</span></a>
             </div>
           </div>
           <div class="col-md-6 col-12 ">
             <div class="select-btn">
               <a href="">
                <input type="radio" class="form-control">
                <span> 5 Senses</span></a>
             </div>
           </div>
           <div class="col-md-6 col-12 ">
             <div class="select-btn">
               <a href="">
                <input type="radio" class="form-control">
            <span> 5 Senses</span></a>
             </div>
           </div>
           <div class="col-md-6 col-12 ">
             <div class="select-btn">
               <a href="">
            <input type="radio" class="form-control">
            <span> 5 Senses</span></a>
             </div>
           </div>
         </div>
       </div>
       <div class="pop-up-card pop-card-two" id="step2">
        <div role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="--value: 67"></div>
         <p>Congratulations !</p>
         <h2>You have attempted 20 questions out of 30</h2>
         <div class="main-outer-result">
           <div class="result-inner">
             <div class="result-card">
             <h3>
              <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
              <path d="M13.5002 25.6051C12.2739 25.6051 11.0589 25.2451 10.1027 24.5364L5.26519 20.9251C3.98269 19.9689 2.98145 17.9664 2.98145 16.3801V8.01012C2.98145 6.27762 4.2527 4.43262 5.88395 3.82512L11.4977 1.72137C12.6114 1.30512 14.3664 1.30512 15.4802 1.72137L21.0939 3.82512C22.7252 4.43262 23.9964 6.27762 23.9964 8.01012V16.3689C23.9964 17.9664 22.9952 19.9576 21.7127 20.9139L16.8752 24.5251C15.9414 25.2451 14.7264 25.6051 13.5002 25.6051ZM12.0939 3.30762L6.4802 5.41137C5.52395 5.77137 4.6802 6.98637 4.6802 8.02137V16.3801C4.6802 17.4489 5.43395 18.9451 6.2777 19.5751L11.1152 23.1864C12.4089 24.1539 14.5914 24.1539 15.8964 23.1864L20.7339 19.5751C21.5889 18.9339 22.3314 17.4489 22.3314 16.3801V8.01012C22.3314 6.98637 21.4877 5.77137 20.5314 5.40012L14.9177 3.29637C14.1527 3.02637 12.8477 3.02637 12.0939 3.30762Z" fill="#292D32"/>
              <path d="M11.9925 16.0085C11.7788 16.0085 11.565 15.9298 11.3963 15.761L9.58502 13.9498C9.25877 13.6235 9.25877 13.0835 9.58502 12.7573C9.91127 12.431 10.4513 12.431 10.7775 12.7573L11.9925 13.9723L16.2338 9.73102C16.56 9.40477 17.1 9.40477 17.4263 9.73102C17.7525 10.0573 17.7525 10.5973 17.4263 10.9235L12.5888 15.761C12.42 15.9298 12.2063 16.0085 11.9925 16.0085Z" fill="#292D32"/>
            </svg> 
            <span>17</span></h3>
            <p>Correct Answers</p>
           </div>
           </div>
           <div class="result-inner">
             <div class="result-card">
             <h3><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
              <path d="M13.5002 25.6051C12.2739 25.6051 11.0589 25.2451 10.1027 24.5364L5.26519 20.9251C3.98269 19.9689 2.98145 17.9664 2.98145 16.3801V8.01012C2.98145 6.27762 4.2527 4.43262 5.88395 3.82512L11.4977 1.72137C12.6114 1.30512 14.3664 1.30512 15.4802 1.72137L21.0939 3.82512C22.7252 4.43262 23.9964 6.27762 23.9964 8.01012V16.3689C23.9964 17.9664 22.9952 19.9576 21.7127 20.9139L16.8752 24.5251C15.9414 25.2451 14.7264 25.6051 13.5002 25.6051ZM12.0939 3.30762L6.4802 5.41137C5.52395 5.77137 4.6802 6.98637 4.6802 8.02137V16.3801C4.6802 17.4489 5.43395 18.9451 6.2777 19.5751L11.1152 23.1864C12.4089 24.1539 14.5914 24.1539 15.8964 23.1864L20.7339 19.5751C21.5889 18.9339 22.3314 17.4489 22.3314 16.3801V8.01012C22.3314 6.98637 21.4877 5.77137 20.5314 5.40012L14.9177 3.29637C14.1527 3.02637 12.8477 3.02637 12.0939 3.30762Z" fill="#292D32"/>
              <path d="M11.9925 16.0085C11.7788 16.0085 11.565 15.9298 11.3963 15.761L9.58502 13.9498C9.25877 13.6235 9.25877 13.0835 9.58502 12.7573C9.91127 12.431 10.4513 12.431 10.7775 12.7573L11.9925 13.9723L16.2338 9.73102C16.56 9.40477 17.1 9.40477 17.4263 9.73102C17.7525 10.0573 17.7525 10.5973 17.4263 10.9235L12.5888 15.761C12.42 15.9298 12.2063 16.0085 11.9925 16.0085Z" fill="#292D32"/>
            </svg> <span>17</span></h3>
            <p>Correct Answers</p>
           </div>
           </div>
           <div class="result-inner">
             <div class="result-card">
             <h3><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
              <path d="M13.5002 25.6051C12.2739 25.6051 11.0589 25.2451 10.1027 24.5364L5.26519 20.9251C3.98269 19.9689 2.98145 17.9664 2.98145 16.3801V8.01012C2.98145 6.27762 4.2527 4.43262 5.88395 3.82512L11.4977 1.72137C12.6114 1.30512 14.3664 1.30512 15.4802 1.72137L21.0939 3.82512C22.7252 4.43262 23.9964 6.27762 23.9964 8.01012V16.3689C23.9964 17.9664 22.9952 19.9576 21.7127 20.9139L16.8752 24.5251C15.9414 25.2451 14.7264 25.6051 13.5002 25.6051ZM12.0939 3.30762L6.4802 5.41137C5.52395 5.77137 4.6802 6.98637 4.6802 8.02137V16.3801C4.6802 17.4489 5.43395 18.9451 6.2777 19.5751L11.1152 23.1864C12.4089 24.1539 14.5914 24.1539 15.8964 23.1864L20.7339 19.5751C21.5889 18.9339 22.3314 17.4489 22.3314 16.3801V8.01012C22.3314 6.98637 21.4877 5.77137 20.5314 5.40012L14.9177 3.29637C14.1527 3.02637 12.8477 3.02637 12.0939 3.30762Z" fill="#292D32"/>
              <path d="M11.9925 16.0085C11.7788 16.0085 11.565 15.9298 11.3963 15.761L9.58502 13.9498C9.25877 13.6235 9.25877 13.0835 9.58502 12.7573C9.91127 12.431 10.4513 12.431 10.7775 12.7573L11.9925 13.9723L16.2338 9.73102C16.56 9.40477 17.1 9.40477 17.4263 9.73102C17.7525 10.0573 17.7525 10.5973 17.4263 10.9235L12.5888 15.761C12.42 15.9298 12.2063 16.0085 11.9925 16.0085Z" fill="#292D32"/>
            </svg> <span>17</span></h3>
            <p>Correct Answers</p>
           </div>
           </div>
         </div>
       </div>
       <div class="main-btn-outer">
         <div class="left-btns-div">
           <a href="javascript:void(0)" class="back-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
            <a id="nextButton" href="javascript:void(0)"><span>Next</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M14.4301 18.8201C14.2401 18.8201 14.0501 18.7501 13.9001 18.6001C13.6101 18.3101 13.6101 17.8301 13.9001 17.5401L19.4401 12.0001L13.9001 6.46012C13.6101 6.17012 13.6101 5.69012 13.9001 5.40012C14.1901 5.11012 14.6701 5.11012 14.9601 5.40012L21.0301 11.4701C21.3201 11.7601 21.3201 12.2401 21.0301 12.5301L14.9601 18.6001C14.8101 18.7501 14.6201 18.8201 14.4301 18.8201Z" fill="white"/>
            <path d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z" fill="white"/>
          </svg></a>
          </div>
       </div>
     </div>
   </div>
 </div>
</section>
@endsection

@section('script')
	<script>


      var chrt = document.getElementById("chartId").getContext("2d");
      var chartId = new Chart(chrt, {
         type: 'doughnut',
         data: {
            labels: ["Quiz Title Goes 1", "Quiz Title Goes 2", "Quiz Title Goes 3"],
            datasets: [{
            // label: "online tutorial subjects",
            data: [50, 15, 15, 20],
            backgroundColor: ['#e2c5e4', '#eecbb0', '#dfe5b6', '#ffff'],
            hoverOffset: 5
            }],
         },
         options: {
            responsive: false,
         },
      });

$(document).ready(function() {

    $("#nextButton").click(function() {
        $("#step1").hide(); // Hide the first card
        $("#step2").show(); // Show the second card
    });
    $(".back-btn").click(function() {
       $("#step1").show(); // Hide the first card
        $("#step2").hide(); // Show the second card
    });
    

    $(".my-popup").click(function() {
       console.log("working");
        $(".pop-up-sec").show();
    });
    
    // Hide pop-up when clicking cross icon
    $(".cross-icon i").click(function() {
      console.log("working cross");
        $(".pop-up-sec").hide();
    });
});

// ist chart

var canvas = document.getElementById("columnChart");

var data = {
    labels: ["", "", "", "", "", ""], // Empty labels for no x-axis labels
    datasets: [
        {
            data: [240, 360, 700, 250, 180, 160], // Heights of columns
            backgroundColor: ["#f8f0f0", "#f8f0f0", "#af232b", "#f8f0f0", "#f8f0f0", "#f8f0f0"], // Colors for columns
        },
    ],
};

var chart = new Chart(canvas, {
    type: "bar",
    data: data,
    options: {
        plugins: {
            tooltip: {
                enabled: true, // Enable tooltips
                callbacks: {
                    title: function(context) {
                        return "Column " + (context[0].dataIndex + 1);
                    },
                },
            },
        },
        scales: {
            x: {
                display: false, // Hide x-axis
            },
            y: {
                display: false, // Hide y-axis
            },
        },
        layout: {
            padding: {
                top: 10, // Add some top padding for better tooltip display
            },
        },
        plugins: {
            legend: {
                display: false, // Hide the legend
            },
        },
    },
});





   </script>
@endsection