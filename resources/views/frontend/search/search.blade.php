@extends('frontend.layouts.main')
@section('tittle')
<title>Dashboard</title>
@endsection
@section('content')
<section class="video-sec">
    <div class="container">
        <div class="video-main-outer">
            <div class="video-left-content">
                <h2>You Search For :
                    <?php if(isset($_GET['query'])){ echo $_GET['query']; } ?>
                </h2>
            </div>

        </div>

        @if ($video->count()>0)
        <div>
            <h4 style="border-bottom: 2px solid black;padding-bottom:5px;margin-bottom:20px">
                Video
            </h4>
        </div>
        @endif
        <div class="row">
            @foreach($video as $r)
            <div class="col-md-3 col-12">
                <div class="video-cards">
                    <a href="{{ url('video') }}/{{ $r->url }}">
                        <video style="width: 100%;">
                            <source src="{{ url('public/images') }}/{{ $r->video }}" type="video/mp4" />
                        </video>
                        <h2>{{ $r->name }}</h2>
                        @if($r->duration)
                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $r->duration }} Sec</span>
                        @endif
                    </a>
                </div>
            </div>
            @endforeach
        </div>


        @if ($slideshow->count()>0)
        <div>
            <h4 style="border-bottom: 2px solid black;padding-bottom:5px;margin-bottom:20px">
                Slideshow
            </h4>
        </div>
        @endif
       

        <div class="row">
            @foreach($slideshow as $r)
            <div class="col-md-3 col-12">
              <div class="video-cards">
                <a href="{{ url('slideshow') }}/{{ $r->url }}">
                  <img src="{{ url('public/images') }}/{{ $r->image }}" style="width: 100%; height: 200px;" class="img-fluid">
                  <h2>{{ $r->name }}</h2>              
                </a>
                <a class="downloadbutton" href="{{ url('public/images') }}/{{ $r->video }}" download="">Download</a>
              </div>
            </div>
            @endforeach
          </div>



        @if ($quizes->count()>0)
        <div>
            <h4 style="border-bottom: 2px solid black;padding-bottom:5px;margin-bottom:20px">
                Quizes
            </h4>
        </div>
        @endif


        <div class="row">
        
            @foreach($quizes as $r)
            <div class="latest-quiz-card col-md-12">
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
             </div>
            @endforeach
          
          </div>

    </div>
</section>
@endsection

