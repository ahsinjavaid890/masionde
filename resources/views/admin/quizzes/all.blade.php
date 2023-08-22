@extends('admin.layouts.main-layout')
@section('title','All Quizzes')

@section('adminbeardcumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/quizzes') }}" class="text-muted">All Quizzes</a>
</li>
@endsection

@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                @include('alerts.index')
                <!--begin::Card-->
                <div class="card card-custom mt-5">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                Manage Quizzes
                                <div class="text-muted pt-2 font-size-sm">Manage Quizzes</div>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a href="{{ url('admin/quizzes/addnew') }}" class="btn btn-primary font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <circle fill="#000000" cx="9" cy="15" r="6" />
                                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon--></span> Add New Quizz
                            </a>
                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-separate table-head-custom table-checkable" id="userTable">
                            <thead>
                                <tr>
                                    <th scope="col">Quiz Title</th>
                                    <th scope="col">Questions</th>
                                    <th scope="col">Taken By Users</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-items-center">
                                    <td class="sorting_1 dtr-control">
                                        Quiz Title Goes here
                                    </td>
                                    <td>20</td>
                                    <td>3</td>
                                    <td>Active</td>
                                    <td nowrap="">
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                             <i class="la la-edit"></i> 
                                        </a>
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
</div>
@endsection