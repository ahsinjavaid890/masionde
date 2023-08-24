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
        @if(Cmf::gettimeforday() == 'Good night')
        <img src="https://cdn-icons-png.flaticon.com/512/180/180700.png">
        @endif
        @if(Cmf::gettimeforday() == 'Good morning')
         <img src="{{ url('public/assets/images/sun.png') }}">
        @endif
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
                <h2>{{round($percentageofquizes*100, 0)}}%</h2>
              </div>
              <div class="left-chart-media">
                <canvas id="columnChart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="left-chart">
            <div class="main-outer">
              <div class="left-chart-cntent">
                <p>Attempt Quizzes</p>
                @php
                  $llquizes = DB::table('quizzes')->where('status' , 'Active')->count();
                  $userquizzes = DB::table('userquizes')->where('user_id' , Auth::user()->id)->where('status' , 'done')->count();

                  $percentage = $userquizzes/$userquizzes;
                @endphp
                <h2>{{round($percentage*100, 0)}}%</h2>
              </div>
              <div class="left-chart-media">
                 <canvas id="chartId" aria-label="chart"></canvas>
              </div>
            </div>
          </div>
        </div>           
      </div>
      <div class="row r-mar">
        <div class="col-md-7 col-12">
          <div class="latest-quiz-card">
           <h2>Latest Quizzes</h2>
           <p></p>
           @foreach($quizzes as $r)
           <div class="main-outer quiz-outer">
             <div class="quiz-left">
               <div class="main-outer">
                 <div class="quiz-left-inner">
                   <div class="quiz-inner-img">
                    <div class="quiz-media">
                      @if($r->image)
                      <img src="{{ url('public/images') }}/{{ $r->image }}">
                      @else
                      <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930">
                      @endif
                    </div>
                   </div>
                 </div>
                 <div class="quiz-right-inner">
                   <h2><a href="{{ url('quiz') }}/{{ $r->url }}">{{ $r->name }}</a></h2>
                   <p>{{ DB::table('questions')->where('quiz_id' , $r->id)->count() }} Questions <span><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $r->duration }} min</span></p>
                 </div>
               </div>
             </div>
             <div class="quiz-btn">
              @if(DB::table('userquizes')->where('user_id' , Auth::user()->id)->where('quiz_id', $r->id)->where('status' , 'done')->count() == 0)
               <a href="{{ url('quiz') }}/{{ $r->url }}" class="my-popup">Take Quiz</a>
               @else
               <a href="{{ url('quiz') }}/{{ $r->url }}" class="my-popup">{{ DB::table('userquizes')->where('user_id' , Auth::user()->id)->where('quiz_id' , $r->id)->where('status' , 'done')->first()->score }} Out of {{ DB::table('userquizes')->where('user_id' , Auth::user()->id)->where('quiz_id' , $r->id)->where('status' , 'done')->first()->total }}</a>
               @endif
             </div>
           </div>
           @endforeach
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

@php
    $userquizes = DB::table('userquizes')->where('user_id' , Auth::user()->id)->where('status' , 'done')->get();
@endphp
@endsection

@section('script')
	<script>


      var chrt = document.getElementById("chartId").getContext("2d");
      var chartId = new Chart(chrt, {
         type: 'doughnut',
         data: {
            labels: [@foreach($userquizes as $r)"Quiz Goes {{ round($r->score/$r->total * 100 , 0) }} %" @if($loop->last) @else , @endif @endforeach],
            datasets: [{
            // label: "online tutorial subjects",
            data: [@foreach($userquizes as $r) {{ round($r->score/$r->total * 100 , 0) }} @if($loop->last) @else , @endif @endforeach],
            backgroundColor: [@foreach($userquizes as $r) '#e2c5e4' @if($loop->last) @else , @endif @endforeach],
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