@extends('frontend.layouts.main')
@section('tittle')
<title>All Quizzes</title>
@endsection
@section('content')
<section class="video-sec">
    <div class="container">
      <div class="video-main-outer">
        <div class="video-left-content">
          <h2>All Quizzes</h2>
        </div>
      </div>
      <div class="row">
        
        @foreach($data as $r)
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