@extends('admin.layouts.main-layout')
@section('title','All Users')
@section('adminbeardcumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/users') }}" class="text-muted">All Users</a>
</li>
@endsection
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container">
            <!--begin::Card-->
            @include('alerts.index')
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
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
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