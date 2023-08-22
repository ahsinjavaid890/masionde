@extends('admin.layouts.main-layout')
@section('title','Dashboard')
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="content  d-flex flex-column flex-column-fluid mt-8" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                @include('alerts.index')
                <div class="row">
                    <div class="col-md-3">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a href="{{ url('admin/users') }}" class="font-weight-bold
                                    text-dark-75
                                    text-hover-primary
                                    font-size-lg
                                    mb-1">
                                <!--begin::Item-->
                                <div class="pt-7 pb-7 pl-4 d-flex align-items-center mb-4 bg-white rounded p-5">
                                    

                                    <span class="svg-icon svg-icon-3x d-block my-2 mr-3">
                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>

                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    
                                    <div class="d-flex
                                    flex-column flex-grow-1
                                    mr-2"> Manage Users <span class="text-muted
                                    font-weight-bold">Invite New Member</span>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Lable-->
                                    <span class="font-weight-bolder py-1 font-size-lg">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                                    
                                    <!--end::Lable-->
                                </div>
                                <!--end::Item-->
                                </a>
                            </div>
                            <div class="col-md-12">
                                <!--begin::Item-->
                                <a href="{{ url('admin/slideshows') }}" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">
                                <div class="pt-7 pb-7 pl-4 d-flex align-items-center mb-4 bg-white rounded p-5">
                                    

                                    <!--begin::Icon-->
                                    <span class="svg-icon svg-icon-3x d-block my-2 mr-3">
                                        <span class="svg-icon svg-icon-lg">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                                                    <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>

                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        Slideshows
                                        <span class="text-muted font-weight-bold">Manage Slideshows</span>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Lable-->
                                    <span class="font-weight-bolder text-warning py-1 font-size-lg">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                                    <!--end::Lable-->
                                </div>
                                <!--end::Item-->
                                </a>
                            </div>
                            <div class="col-md-12">
                                <!--begin::Item-->
                                <a href="{{ url('admin/videos') }}" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">
                                <div class="pt-7 pb-7 pl-4 d-flex align-items-center mb-4 bg-white rounded p-5">
                                    <!--begin::Icon-->
                                    <span class="svg-icon svg-icon-3x d-block my-2 mr-3">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        Videos
                                        <span class="text-muted font-weight-bold">Manage All Videos</span>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Lable-->
                                    <span class="font-weight-bolder text-warning py-1 font-size-lg">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                                    <!--end::Lable-->
                                </div>
                                <!--end::Item-->
                                </a>
                            </div>
                            <div class="col-md-12">
                                <!--begin::Item-->
                                <a href="{{ url('admin/quizzes') }}" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">
                                <div class="pt-7 pb-7 pl-4 d-flex align-items-center mb-4 bg-white rounded p-5">
                                    <!--begin::Icon-->
                                    <span class="svg-icon svg-icon-3x d-block my-2 mr-3">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                                                <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        Quizzes
                                        <span class="text-muted font-weight-bold">Manage All Quizzes</span>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Lable-->
                                    <span class="font-weight-bolder text-warning py-1 font-size-lg">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                                    <!--end::Lable-->
                                </div>
                                <!--end::Item-->
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <!--begin::Card-->
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap py-5">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        Manage Users
                                        <div class="text-muted pt-2 font-size-sm">Manage your users/staff memebers</div>
                                    </h3>
                                </div>
                                <div class="card-toolbar">
                                    <!--begin::Button-->
                                    <a href="#" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModalScrollable">
                                        <span class="svg-icon svg-icon-md">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <circle fill="#000000" cx="9" cy="15" r="6" />
                                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon--></span> Add New Member
                                    </a>
                                    <!--end::Button-->
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-separate table-head-custom table-checkable" id="userTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Added Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach(DB::table('users')->where('type' , '!=' , 'admin')->get() as $r)
                                        <tr class="align-items-center">
                                            <td class="sorting_1 dtr-control">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50 flex-shrink-0">
                                                    	@if($r->profileimage)
                                                    	<img src="{{ url('public/images') }}/{{ $r->profileimage }}" alt="{{ $r->name }}">
                                                    	@else
                                                        <img src="{{ url('https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930') }}" alt="photo">
                                                        @endif
                                                    </div>
                                                    <div class="ml-3">
                                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">{{ $r->name }}</span>
                                                        <a href="javascript:void(0)" class="text-muted text-hover-primary">{{ $r->email }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $r->phonenumber }}</td>
                                            <td>{{ Cmf::date_format($r->created_at) }}</td>
                                            <td>
                                                @if($r->status == 'inactive')

                                                <span class="badge badge-danger">In Active</span>

                                                @else

                                                <span class="badge badge-success">Active</span>
                                            @endif</td>   
                                            <td nowrap="">
                                                <a href="{{ url('admin/users/edit') }}/{{ $r->id }}" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>
                                                <a data-toggle="modal" data-target="#deleteModal{{ $r->id }}" href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                                    <i class="la la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="deleteModal{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <form method="POST" action="{{ url('admin/users/delete') }}">
                                                @csrf
                                            <input type="hidden" value="{{ $r->id }}" name="id">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you Sure you want to Delete this?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you Sure you want to Delete this User?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger font-weight-bold">Yes, Delete it</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!--end: Datatable-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
</div>
<!--end::Content-->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Invite user <br>
                    <small class="-mt-4">invite a user to join our platform</small>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="POST" action="{{ url('admin/users/create') }}">
                @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="lable-control">Name</label>
                            <input value="{{old('name')}}" type="text" class="form-control input-lg"  name="name">
                            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="lable-control">Email</label>
                            <input value="{{old('email')}}" type="text" class="form-control input-lg"  name="email">
                            {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="lable-control">Phone number</label>
                            <input value="{{old('phonenumber')}}" type="text" class="form-control input-lg" name="phonenumber">
                            {!!$errors->first("phonenumber", "<span class='text-danger'>:message</span>")!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="lable-control">Password</label>
                            <input type="password"  class="form-control input-lg" name="password">
                            {!!$errors->first("password", "<span class='text-danger'>:message</span>")!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="lable-control">Confirm password</label>
                            <input type="password"  class="form-control input-lg" name="confirm_password">
                            {!!$errors->first("confirm_password", "<span class='text-danger'>:message</span>")!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light text-black font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary font-weight-bold">Send Invitation</button>
            </div>
        </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    @if(isset($errors))
    @if($errors->count() > 0)
    $(document).ready(function() {
        $('#exampleModalScrollable').modal('show')
    });
    @endif
    @endif

</script>
@endsection