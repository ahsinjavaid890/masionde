@extends('frontend.layouts.main')
@section('tittle')
<title>{{ $data->name }}</title>
@endsection
@section('content')
<section class="video-details-sec">
 <div class="container">
   <div class="main-outer video-outer">
     <div class="left-video">
       <img src="assets/images/slideshow-bigger.png" style="width:100%; height:320px">
       <div class="row mt-3">
         <div class="col-md-3">
           <img src="assets/images/slideshows1.png" class="img-fluid">
         </div>
         <div class="col-md-3">
           <img src="assets/images/slideshows1.png" class="img-fluid">
         </div>
         <div class="col-md-3">
           <img src="assets/images/slideshows1.png" class="img-fluid">
         </div>
         <div class="col-md-3">
           <img src="assets/images/slideshows1.png" class="img-fluid">
         </div>
       </div>
     </div>
     <div class="video-right-details">
       <h6>Trading & Stats<br>
        
       </h6>
       <h2 class="mb-0">{{ url('public/images') }}/{{ $data->video }}</h2>
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
      @FOREACH($relatedslideshow as $r)
      <div class="col-md-3 col-12">
          <div class="video-cards">
            <a href="{{ url('slideshow') }}/{{ $r->url }}">
              <img src="{{ url('public/images') }}/{{ $r->image }}" class="img-fluid">
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
@section('script')
<script type="text/javascript">
  $(document).ready(function() {

    $(".video-right-content p").click(function(e) {
      e.stopPropagation(); // Prevent event from bubbling up
      console.log("working");
      $(".filter-card").toggle();
    });

    // Prevent hiding when clicking inside the .filter-card
    $(".filter-card").click(function(e) {
      e.stopPropagation(); // Prevent event from bubbling up
    });

    // Hide pop-up when clicking anywhere else on the page
    $("body").click(function() {
      console.log("working cross");
      $(".filter-card").hide();
    });
  });
</script>
@endsection