<!--begin::Aside-->
<div class="aside aside-left d-flex flex-column " id="kt_aside">
    <!--end::Brand-->
    <!--begin::Nav Wrapper-->
    <div class="aside-nav d-flex flex-column align-items-center flex-column-fluid pt-7">
        <!--begin::Nav-->
        <ul class="nav flex-column">
            <!--begin::Item-->
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Dashboard">
                <a href="{{ url('admin/dashboard') }}" class="nav-link btn btn-icon btn-clean btn-icon-white btn-lg active">
                    <i class="flaticon2-protection icon-lg"></i>
                </a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Slideshows">
                <a href="{{ url('admin/slideshows') }}" class="nav-link btn btn-icon btn-icon-white btn-lg">
                    <i class="flaticon2-files-and-folders icon-lg"></i>
                </a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Videos">
                <a href="{{ url('admin/videos') }}" class="nav-link btn btn-icon btn-icon-white btn-lg">
                    <i class="flaticon-imac icon-lg"></i>
                </a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Quizzes">
                <a href="{{ url('admin/quizzes') }}" class="nav-link btn btn-icon btn-icon-white btn-lg">
                    <i class="flaticon-layers icon-lg"></i>
                </a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Users">
                <a href="{{ url('admin/dashboard') }}" class="nnav-link btn btn-icon btn-icon-white btn-lg">
                    <i class="flaticon-users icon-lg"></i>
                </a>
            </li>
            <!--end::Item-->
        </ul>
        <!--end::Nav-->
    </div>
    <!--end::Nav Wrapper-->
    <div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-8">
        <a href="{{ url('admin/profile') }}" class="btn btn-icon btn-clean btn-lg mb-1" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Settings">
            <span class="svg-icon svg-icon-xl">
                <i class="flaticon-settings icon-lg text-white"></i>
            </span>
        </a>
        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-icon btn-clean btn-lg mb-1" title="" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Logout">
            <span class="svg-icon svg-icon-xl">
                <i class="flaticon-logout icon-lg text-white"></i>
            </span>
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <!--end::Quick Panel-->
    </div>
</div>
<!--end::Aside-->