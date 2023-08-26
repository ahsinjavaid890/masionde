@php
    $url = request()->segment(count(request()->segments()));
@endphp
<header>
    <div class="container">
        <div class="row">
          <nav class="navbar navbar-expand-lg navbar-light my-navbar">
            <a class="navbar-brand" href="{{ url('') }}"><img src="{{ url('public/assets/images/logo.png') }}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav my-ul">
                <li>
                  <a @if(Request::segment(1) == 'dashboard') style="color:#af232b;" @endif @if(Request::segment(1) == 'home') style="color:#af232b;" @endif href="{{ url('dashboard') }}">Dashboard </a>
                </li>
                <li><a @if(Request::segment(1) == 'slideshows') style="color:#af232b;" @endif href="{{ url('slideshows') }}">Slideshows</a></li>
                <li><a @if(Request::segment(1) == 'videos') style="color:#af232b;" @endif href="{{ url('videos') }}">Videos</a></li>
                <li><a @if(Request::segment(1) == 'quizes') style="color:#af232b;" @endif href="{{ url('quizes') }}">Quizzes</a></li>
              </ul>
              <form class="form-inline my-2 my-lg-0" action="{{ url('search')}}" method="GET">
                <div class="search-box">
                    <input type="text" class="search-input" required value="<?php if(isset($_GET['query'])){ echo $_GET['query']; } ?>" name="query" placeholder="Search...">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                      <path d="M8.625 16.3125C4.3875 16.3125 0.9375 12.8625 0.9375 8.625C0.9375 4.3875 4.3875 0.9375 8.625 0.9375C12.8625 0.9375 16.3125 4.3875 16.3125 8.625C16.3125 12.8625 12.8625 16.3125 8.625 16.3125ZM8.625 2.0625C5.0025 2.0625 2.0625 5.01 2.0625 8.625C2.0625 12.24 5.0025 15.1875 8.625 15.1875C12.2475 15.1875 15.1875 12.24 15.1875 8.625C15.1875 5.01 12.2475 2.0625 8.625 2.0625Z" fill="#5E5E5E"/>
                      <path d="M16.5 17.0626C16.3575 17.0626 16.215 17.0101 16.1025 16.8976L14.6025 15.3976C14.385 15.1801 14.385 14.8201 14.6025 14.6026C14.82 14.3851 15.18 14.3851 15.3975 14.6026L16.8975 16.1026C17.115 16.3201 17.115 16.6801 16.8975 16.8976C16.785 17.0101 16.6425 17.0626 16.5 17.0626Z" fill="#5E5E5E"/>
                    </svg>
                </div>
              </form>
                <div class="notification">
                  <button class="notification-icon"><img src="{{ url('public/assets/images/notification-status.png') }}" alt="Notification"></button>
                  <div class="notification-dropdown">
                      <p>You have new notifications!</p>
                      @foreach(DB::table('user_notifications')->where('user_id' , Auth::user()->id)->where('status' , 'new')->get() as $r)
                        <a onclick="clicknotification({{$r->id}})" href="javascript:void(0)">{{ $r->notification }}</a>
                      @endforeach
                  </div>
               </div>
                 <div class="profile">
                      <button class="profile-icon">
                        @if(Auth::user()->profileimage)
                        <img src="{{ url('public/images') }}/{{ Auth::user()->profileimage }}" alt="{{ Auth::user()->name }}">
                        @else
                        <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930" alt="{{ Auth::user()->name }}">
                        @endif
                        
                      </button>
                      <div class="profile-dropdown">
                          <p>Welcome, {{ Auth::user()->name }}!</p>
                          <a href="{{ url('profile') }}">Profile</a>
                          <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                      </div>
                  </div>

              
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
            </div>
         </nav>
        </div>
    </div>
</header>
<script type="text/javascript">
  function clicknotification(id) {
      $.ajax({
          type: 'get',
          url: "{{ url('clicknotification') }}/"+id,
          success: function(response) {
              $(location).attr('href',response);
          }
      });
  }
</script>