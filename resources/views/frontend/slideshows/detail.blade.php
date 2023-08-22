@extends('frontend.layouts.main')
@section('tittle')
<title>{{ $data->name }}</title>
@endsection
@section('content')
<section class="video-details-sec">
 <div class="container">
   <div class="main-outer video-outer">
     <div class="left-video">
      <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{  url('public/images') }}/{{ $data->video }}" width='100%' height='600px' frameborder='0'>
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
      <div class="col-md-3 col-12">
        <div class="video-cards">
          <a href="slideshow-detail.html">
            <img src="assets/images/slideshows1.png" class="img-fluid">
            <h2>Puzzle - Education Keynote Template</h2>
            <span>Download</span>
          </a>
        </div>
      </div>
      <div class="col-md-3 col-12">
        <div class="video-cards">
          <a href="slideshow-detail.html">
            <img src="assets/images/slideshows2.png" class="img-fluid">
            <h2>Puzzle - Education Keynote Template</h2>
            <span>Download</span>
          </a>
        </div>
      </div>
      <div class="col-md-3 col-12">
        <div class="video-cards">
          <a href="slideshow-detail.html">
            <img src="assets/images/slideshows3.png" class="img-fluid">
            <h2>Puzzle - Education Keynote Template</h2>
            <span>Download</span>
          </a>
        </div>
      </div>
      <div class="col-md-3 col-12">
        <div class="video-cards">
          <a href="slideshow-detail.html">
            <img src="assets/images/slideshows4.png" class="img-fluid">
            <h2>Mythology Trivia: Gods, Heroes, and Legends</h2>
            <span>Download</span>
          </a>
        </div>
      </div>
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