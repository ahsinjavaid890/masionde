@extends('frontend.layouts.main')
@section('tittle')
<title>{{ $data->name }}</title>
@endsection
@section('content')
<section class="video-details-sec">
  <div class="container">
    <div class="main-outer video-outer">
      <div class="left-video">
          <embed src="https://view.officeapps.live.com/op/view.aspx?src={{ url('public/images') }}/{{ $data->video }}#toolbar=0" style="width:100%; height:500px;">
      </div>
      <div class="video-right-details">
        <h6>{{ DB::table('slideshow_categories')->where('id' , $data->category_id)->first()->name }}<br>
        </h6>
        <h2 class="mb-0">{{ $data->name }}</h2>
        <p>{{ $data->short_description }}</p>
      </div>
    </div>
  </div>
</section>
<!-- main page end here -->
<!-- video section start here -->
<section class="video-sec">
  <div class="container">
    <div class="video-main-outer">
      <div class="video-left-content">
        <h2>Related Slideshows</h2>
      </div>
    </div>
    <div class="row">
      @foreach($relatedslideshow as $r)
      <div class="col-md-3 col-12">
          <div class="video-cards">
            <a href="{{ url('slideshow') }}/{{ $r->url }}">
              @if($r->image)
              <img src="{{ url('public/images') }}/{{ $r->image }}" style="width: 100%; height: 200px;" class="img-fluid">
              @else
              <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930" style="width: 100%; height: 200px;" class="img-fluid">
              @endif
              <h2>{{ $r->name }}</h2>              
            </a>
            <a class="downloadbutton" href="{{ url('public/images') }}/{{ $r->video }}" download="">Download</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection