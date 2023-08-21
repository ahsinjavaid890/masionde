<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('public/admin/assets-dashboard/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/assets-dashboard/plugins/custom/leaflet/leaflet.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/assets-dashboard/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/assets-dashboard/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/assets-dashboard/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <input type="hidden" value="{{ url('') }}" id="app_url">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ url('public/images') }}/{{ Cmf::get_store_value('favicon') }}" rel="shortcut icon" />  
    <script src="{{ asset('public/admin/assets/plugins/global/plugins.bundle.js?v=7.0.6') }}"></script>
</head>
  <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">    
        @include('admin.includes.navbar')
        
        <!--end::Header Mobile-->
	    <div class="d-flex flex-column flex-root">
	        <!--begin::Page-->
	        <div class="d-flex flex-row flex-column-fluid page">
	        	@include('admin.includes.sidebar')

	        	<!--begin::Wrapper-->
	            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
	                <!--begin::Header-->
	                @include('admin.includes.header')
	                @yield('content')
	            </div>
	        </div>
	    </div>        
        <!--end::Global Config-->
        <!--begin::Global Theme Bundle(used by all pages)-->
        
        <script src="{{ asset('public/admin/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6') }}"></script>
        <script src="{{ asset('public/admin/assets/js/scripts.bundle.js?v=7.0.6') }}"></script>
        <!--end::Global Theme Bundle-->
        <!--begin::Page Vendors(used by this page)-->
        <script src="{{ asset('public/admin/assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6') }}"></script>
        <!--end::Page Vendors-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="{{ asset('public/admin/assets/js/pages/crud/datatables/advanced/column-rendering.js?v=7.0.6') }}"></script>
        <!--end::Page Scripts-->
    </body>
@yield('script')
</html>
