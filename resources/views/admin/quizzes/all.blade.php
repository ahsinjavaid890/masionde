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
                                    <th scope="col">Add Question</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $r)
                                <tr class="align-items-center">
                                    <td class="sorting_1 dtr-control">
                                        {{ $r->name }}
                                    </td>
                                    <td>{{ DB::table('questions')->where('quiz_id' , $r->id)->count() }}</td>
                                    <td>{{ DB::table('userquizes')->where('quiz_id' , $r->id)->where('status' , 'done')->count() }}</td>
                                    <td>@if($r->status == 'In Active')<span class="badge badge-danger">{{ $r->status }}</span> @else <span class="badge badge-success">{{ $r->status }}</span> @endif</td>
                                    <td><a class="btn btn-primary" href="{{ url('admin/quizzes/addquestion') }}/{{ $r->id }}">Add Question</a></td>
                                    <td nowrap="">
                                        <a data-toggle="modal" data-target="#updatemodal{{ $r->id }}" href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                             <i class="la la-edit"></i> 
                                        </a>
                                        <a href="{{ url('admin/quizzes/viewquiz') }}/{{ $r->id }}" class="btn btn-sm btn-clean btn-icon" title="View details">
                                             <i class="la la-eye"></i> 
                                        </a>
                                        <a data-toggle="modal" data-target="#deleteModal{{ $r->id }}" href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deleteModal{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form method="POST" action="{{ url('admin/quizzes/delete') }}">
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
                                            Are you Sure you want to Delete this Quiz If you Delete this Quiz then Automaticaly Deleted All Data Against This Quiz in User Panel Also?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger font-weight-bold">Yes, Delete it</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                                <div class="modal fade" id="updatemodal{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <form enctype="multipart/form-data" method="POST" action="{{ url('admin/quizzes/updatequiz') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $r->id }}" name="id">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Quiz : {{ $r->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="lable-control">Quiz Title</label>
                                                            <input value="{{ $r->name }}" required type="text" class="form-control form-control-md form-control-solid" name="name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="lable-control">Short Description</label>
                                                            <textarea name="short_description" class="form-control form-control-md form-control-solid" rows="3">{{ $r->short_description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="lable-control">Banner Image</label>
                                                            <input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control form-control-md form-control-solid" name="image">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="lable-control">Quiz Duration (mins)</label>
                                                            <input required type="number" value="{{ $r->duration }}" class="form-control form-control-md form-control-solid" name="duration">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="lable-control">Quiz Status</label>
                                                            <select class="form-control" name="status">
                                                                <option @if($r->status == 'In Active') selected @endif value="In Active">In Active</option>
                                                                <option @if($r->status == 'Active') selected @endif value="Active">Active</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary font-weight-bold">Update Quiz</button>
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
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
</div>
@endsection