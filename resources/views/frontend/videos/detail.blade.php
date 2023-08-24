@extends('frontend.layouts.main')
@section('tittle')
<title>{{ $data->name }}</title>
@endsection
@section('content')
<section class="video-details-sec">
   <div class="container">
     <div class="main-outer video-outer">
       <div class="left-video">
         <video controls>
          <source src="{{ url('public/images') }}/{{ $data->video }}" type="video/mp4" />
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
          @foreach($relatedvideos as $r)
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
      </div>
    </section>
@endsection