@extends('frontend.layouts.main')
@section('tittle')
<title>Dashboard</title>
@endsection
@section('content')
<section class="video-details-sec">
   <div class="container">
     <div class="main-outer video-outer">
       <div class="left-video">
         <video poster="@if($data->image) {{ url('public/images') }}/{{ $data->image }} @else https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930 @endif" style="height: 350px;" controls="">
            <source src="{{ url('public/images') }}/{{ $data->video }}" type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
          </video>
       </div>
       <div class="video-right-details">
         <h6>Trading & Stats</h6>
         <h2>{{ $data->name }}</h2>
         @if($data->duration)
         <span><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $data->duration }} sec</span>
         @endif
         <p>{{ $data->short_description }}</p>
       </div>
     </div>
   </div>
 </section>
 <section class="video-sec">
      <div class="container">
        <div class="video-main-outer">
          <div class="video-left-content">
            <h2>Related Videos</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-12">
            <div class="video-cards">
              <a href="">
                <img src="assets/images/video-1.png" class="img-fluid">
                <h2>Mythology Trivia: Gods, Heroes, and Legends</h2>
                <span><i class="fa fa-clock-o" aria-hidden="true"></i> 30 min</span>
              </a>
            </div>
          </div>
          <div class="col-md-3 col-12">
            <div class="video-cards">
              <a href="">
                <img src="assets/images/video-2.png" class="img-fluid">
                <h2>Mythology Trivia: Gods, Heroes, and Legends</h2>
                <span><i class="fa fa-clock-o" aria-hidden="true"></i> 30 min</span>
              </a>
            </div>
          </div>
          <div class="col-md-3 col-12">
            <div class="video-cards">
              <a href="">
                <img src="assets/images/video-3.png" class="img-fluid">
                <h2>Mythology Trivia: Gods, Heroes, and Legends</h2>
                <span><i class="fa fa-clock-o" aria-hidden="true"></i> 30 min</span>
              </a>
            </div>
          </div>
          <div class="col-md-3 col-12">
            <div class="video-cards">
              <a href="">
                <img src="assets/images/video-4.png" class="img-fluid">
                <h2>Mythology Trivia: Gods, Heroes, and Legends</h2>
                <span><i class="fa fa-clock-o" aria-hidden="true"></i> 30 min</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection