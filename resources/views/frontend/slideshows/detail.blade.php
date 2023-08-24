@extends('frontend.layouts.main')
@section('tittle')
<title>{{ $data->name }}</title>
@endsection
@section('content')
<link rel="stylesheet" href="{{ url('public/pptx/css/pptxjs.css') }}">
<link rel="stylesheet" href="{{ url('public/pptx/css/nv.d3.min.css') }}">
<script type="text/javascript" src="{{ url('public/pptx/js/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ url('public/pptx/js/filereader.js') }}"></script>
<script type="text/javascript" src="{{ url('public/pptx/js/d3.min.js') }}"></script>
<script type="text/javascript" src="{{ url('public/pptx/js/nv.d3.min.js') }}"></script>
<script type="text/javascript" src="{{ url('public/pptx/js/pptxjs.js') }}"></script>
<script type="text/javascript" src="{{ url('public/pptx/js/divs2slides.js') }}"></script>
<script type="text/javascript" src="{{ url('public/pptx/js/jquery.fullscreen-min.js') }}"></script>
<section class="video-details-sec">
  <div class="container">
    <div class="main-outer video-outer">
      <div class="left-video">
        <div id="result"></div>
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
<script>
  $("#result").pptxToHtml({
  pptxFileUrl: "{{ url('public/images') }}/{{ $data->video }}",
  fileInputId: "uploadFileInput",
  slideMode: true,
  keyBoardShortCut: true,
  slideModeConfig: {  //on slide mode (slideMode: true)
      first: 1, 
      nav: true, /** true,false : show or not nav buttons*/
      navTxtColor: "white", /** color */
      navNextTxt:"&#8250;", //">"
      navPrevTxt: "&#8249;", //"<"
      showPlayPauseBtn: true,/** true,false */
      keyBoardShortCut: true, /** true,false */
      showSlideNum: true, /** true,false */
      showTotalSlideNum: true, /** true,false */
      autoSlide: true, /** false or seconds (the pause time between slides) , F8 to active(keyBoardShortCut: true) */
      randomAutoSlide: true, /** true,false ,autoSlide:true */ 
      loop: false,  /** true,false */
      background: false, /** false or color*/
      transition: "default", /** transition type: "slid","fade","default","random" , to show transition efects :transitionTime > 0.5 */
      transitionTime: 1 /** transition time in seconds */
  }
});
</script>
@endsection


@section('script')

@endsection