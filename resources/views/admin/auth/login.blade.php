<!DOCTYPE html>
<html lang="en">
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ url('public/admin/assets/css/pages/login/classic/login-4.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/admin/assets/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/admin/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/admin/assets/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/admin/assets/css/themes/layout/header/base/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/admin/assets/css/themes/layout/header/menu/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/admin/assets/css/themes/layout/brand/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/admin/assets/css/themes/layout/aside/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="assets/media/logos/fav-icon.png" />
</head>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ url("public/admin/assets/media/bg/bg-3.jpg") }}');">
                <div class="login-form text-center p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="{{ url('') }}">
                            <img src="{{ url('public/admin/assets/media/custom/logo.png') }}" class="max-h-75px" alt="" />
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="card login-card text-left">
                        <div class="card-body">
                            <div class="login-signin">
                                <div class="row text-left signin-card">
                                    <div class="col-md-12">
                                        <h2>Sign In</h2>
                                        <p>User your email and password to login.</p>
                                    </div>
                                </div>
                                @if(Session::get('error'))
                                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                @endif
                                <form action="{{route('admin.login_process')}}" method="POST" class="form mt-4">
                                    @csrf
                                    <div class="form-group mb-5">
                                        <label class="lable-control field-bold">
                                            Email
                                        </label>
                                        <input class="@error('email') is-invalid @enderror form-control h-auto form-control-solid py-4 px-8" value="{{ old('email') }}" type="text" name="email" autocomplete="off" />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-5">
                                        <label class="lable-control field-bold">
                                            Password
                                        </label>
                                        <input class="@error('password') is-invalid @enderror form-control h-auto form-control-solid py-4 px-8" type="password" name="password" />
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="checkbox-inline">
                                            <label class="checkbox m-0 text-muted">
                                                <input type="checkbox" id="remember" name="remember"  {{ old('remember') ? 'checked' : '' }}/>
                                                <span></span>
                                                Remember me
                                            </label>
                                        </div>
                                        <!-- <a href="javascript:;" id="kt_login_forgot" class="text-hover-primary forgot-password">Forget Password ?</a> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="form-control btn btn-pill btn-primary opacity-90 px-15 py-3">Sign In</button>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-center">
                                            <a href="{{ url('') }}">Login as User</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--begin::Login forgot password form-->
                            <div class="login-forgot">
                                <div class="row text-left signin-card">
                                    <div class="col-md-12">
                                        <div class="mb-8">
                                            <h2>Forgotten Password?</h2>
                                            <div class="text-muted font-weight-bold">Enter your email to reset your password</div>
                                        </div>
                                    </div>
                                </div>
                                <form class="form" id="kt_login_forgot_form">
                                    <div class="form-group mb-10">
                                        <label class="lable-control field-bold">
                                            Email Address
                                        </label>
                                        <input class="form-control form-control-solid h-auto py-4 px-8" type="text" name="email" autocomplete="off" />
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-block btn-primary font-weight-bold px-9 py-4 ">Send Reset Link</button>
                                        </div>
                                    </div>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-12">
                                            <p class="remember-password-link">Remember Password? <a href="{{ url('admin/login') }}" id="kt_login_signin_form" class="text-hover-primary forgot-password">Login ?</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Login forgot password form-->
                        </div>
                    </div>
                    <!--end::Login Sign in form-->
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
    <script src="{{ url('public/admin/assets/plugins/global/plugins.bundle.js?v=7.0.6') }}"></script>
    <script src="{{ url('public/admin/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6') }}"></script>
    <script src="{{ url('public/admin/assets/js/scripts.bundle.js?v=7.0.6') }}"></script>
    <script src="{{ url('public/admin/assets/js/pages/custom/login/login-general.js?v=7.0.6') }}"></script>
</body>
</html>