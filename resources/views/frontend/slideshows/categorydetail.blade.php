@extends('frontend.layouts.main')
@section('tittle')
<title>Slideshows</title>
@endsection
@section('content')
<section class="video-sec">
    <div class="container">
      <div class="video-main-outer">
        <div class="video-left-content">
          <h2>{{ $category->name }}</h2>
        </div>
        <div class="video-right-content">
          <p> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
            <path d="M16.5 5.4375H12C11.6925 5.4375 11.4375 5.1825 11.4375 4.875C11.4375 4.5675 11.6925 4.3125 12 4.3125H16.5C16.8075 4.3125 17.0625 4.5675 17.0625 4.875C17.0625 5.1825 16.8075 5.4375 16.5 5.4375Z" fill="#292D32"/>
            <path d="M4.5 5.4375H1.5C1.1925 5.4375 0.9375 5.1825 0.9375 4.875C0.9375 4.5675 1.1925 4.3125 1.5 4.3125H4.5C4.8075 4.3125 5.0625 4.5675 5.0625 4.875C5.0625 5.1825 4.8075 5.4375 4.5 5.4375Z" fill="#292D32"/>
            <path d="M7.5 8.0625C5.745 8.0625 4.3125 6.63 4.3125 4.875C4.3125 3.12 5.745 1.6875 7.5 1.6875C9.255 1.6875 10.6875 3.12 10.6875 4.875C10.6875 6.63 9.255 8.0625 7.5 8.0625ZM7.5 2.8125C6.36 2.8125 5.4375 3.735 5.4375 4.875C5.4375 6.015 6.36 6.9375 7.5 6.9375C8.64 6.9375 9.5625 6.015 9.5625 4.875C9.5625 3.735 8.64 2.8125 7.5 2.8125Z" fill="#292D32"/>
            <path d="M16.5 13.6875H13.5C13.1925 13.6875 12.9375 13.4325 12.9375 13.125C12.9375 12.8175 13.1925 12.5625 13.5 12.5625H16.5C16.8075 12.5625 17.0625 12.8175 17.0625 13.125C17.0625 13.4325 16.8075 13.6875 16.5 13.6875Z" fill="#292D32"/>
            <path d="M6 13.6875H1.5C1.1925 13.6875 0.9375 13.4325 0.9375 13.125C0.9375 12.8175 1.1925 12.5625 1.5 12.5625H6C6.3075 12.5625 6.5625 12.8175 6.5625 13.125C6.5625 13.4325 6.3075 13.6875 6 13.6875Z" fill="#292D32"/>
            <path d="M10.5 16.3125C8.745 16.3125 7.3125 14.88 7.3125 13.125C7.3125 11.37 8.745 9.9375 10.5 9.9375C12.255 9.9375 13.6875 11.37 13.6875 13.125C13.6875 14.88 12.255 16.3125 10.5 16.3125ZM10.5 11.0625C9.36 11.0625 8.4375 11.985 8.4375 13.125C8.4375 14.265 9.36 15.1875 10.5 15.1875C11.64 15.1875 12.5625 14.265 12.5625 13.125C12.5625 11.985 11.64 11.0625 10.5 11.0625Z" fill="#292D32"/>
          </svg> Filter by Category</p>

        </div>
      </div>
          <div class="filter-card">
            <ul>
              @foreach(DB::table('slideshow_categories')->get() as $r)
              <li><a href="{{ url('slidecategory') }}/{{ $r->url }}">{{ $r->name }}</a></li>
              @endforeach
            </ul>
          </div>
      <div class="row">
        @foreach($data as $r)
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
      <div class="row">
        {!! $data->links('frontend.pagination') !!}
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