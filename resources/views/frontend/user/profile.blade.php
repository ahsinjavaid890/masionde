@extends('frontend.layouts.main')
@section('tittle')
<title>My Profile</title>
@endsection
@section('content')
<section class="video-sec">
    <div class="container">
      <div class="video-main-outer">
        <div class="video-left-content">
          <h2>My Profile</h2>
        </div>
      </div>
      <div class="row">
          <div class="col-md-3">
              <div class="row">
                  <div class="col-md-12">
                      <a style="text-decoration: none;background-color: red" href="{{ url('profile') }}" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">
                      <div class="pt-7 pb-7 pl-4 d-flex align-items-center mb-4 rounded p-4" style="background: var(--primary-gradient, linear-gradient(90deg, #8F181F 0%, #C92B35 100%));">
                          <span class="svg-icon svg-icon-xl pr-2">
                              <i class="fa fa-user text-white"></i>
                          </span>
                          <div class="text-white font-weight-bold">My Profile</div>
                      </div>
                      </a>
                  </div>
                  <div class="col-md-12">
                      <a style="text-decoration: none;" href="{{ url('securitysettings') }}" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">
                      <div class="pt-7 pb-7 pl-4 d-flex align-items-center mb-4 bg-white rounded p-4">
                          <span class="svg-icon svg-icon-xl pr-2">
                              <i class="fa fa-cog text-muted"></i>
                          </span>
                          <div class="text-muted font-weight-bold">Security Settings</div>
                      </div>
                      </a>
                  </div>
              </div>
          </div>
          <div class="col-md-9">
              @include('alerts.index')
              <div class="signin-card profilecard">
               <h2>Profile Settings</h2>
               <form enctype="multipart/form-data" method="POST" action="{{ url('updateuserprofile') }}">
                  {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="firstname">Name</label>
                              <input type="text" value="{{ Auth::user()->name }}" class="form-control"
                                  placeholder="First Name" name="name">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="firstname">Email</label>
                              <input readonly="" type="text" value="{{ Auth::user()->email }}"
                                  class="form-control" placeholder="Email" name="email">
                          </div>
                      </div> <!-- end col -->
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="lastname">Contact Number</label>
                              <input type="text" value="{{ Auth::user()->phonenumber }}"
                                  class="form-control" placeholder="Phone No" name="phonenumber">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="lastname">Profile Image</label>
                              <input type="file" class="form-control" placeholder="Phone No"
                                  name="profileimage">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="lastname">About {{ Auth::user()->name }}</label>
                              <textarea rows="7" class="form-control" name="about">{{ Auth::user()->about_me }}</textarea>
                          </div>
                      </div>
                  </div>
                  <div class="text-right">
                      <button type="submit" class="signin-btn">
                   <div class="btn-text">
                     Save Changes
                   </div>
                   <div class="btn-icon">
                     <i class="fa fa-arrow-right" aria-hidden="true"></i>
                   </div>
                 </button>
                  </div>
              </form>
             </div>
          </div>
      </div>
    </div>
  </section>
@endsection