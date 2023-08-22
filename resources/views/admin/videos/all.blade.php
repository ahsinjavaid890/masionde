@extends('admin.layouts.main-layout')
@section('title','All Videos')

@section('adminbeardcumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/videos') }}" class="text-muted">All videos</a>
</li>
@endsection

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container-fluid ">
                @include('alerts.index')
                <div class="row">
                    <div class="col-md-6">
                        <!--begin::Base Table Widget 7-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 mt-5">
                                <h3 class="card-title align-items-start flex-column text-dark">
                                    <span class="font-weight-bolder text-dark">Videos</span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Updated Videos</span>
                                </h3>
                                <div class="card-toolbar">
                                    <form method="GET" action="{{ url('admin/videos/search') }}">
                                        <input @if(isset($_GET['keyword'])) value="{{ $_GET['keyword'] }}" @endif type="text" class="form-control input-xs" placeholder="Keyword and Press Enter" name="keyword">
                                    </form>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-0 mt-n3">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="p-0" style="width: 50px"></th>
                                                <th class="p-0" style="min-width: 150px"></th>
                                                <th class="p-0" style="min-width: 120px"></th>
                                                <th class="p-0" style="min-width: 70px"></th>
                                                <th class="p-0" style="min-width: 70px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($data->count() > 0)
                                            @foreach($data as $r)
                                            <tr>
                                                <td class="pl-0">
                                                    <div class="symbol symbol-50 symbol-fixed mr-2 mt-2">
                                                        @if($r->image)
                                                        <div class="symbol-label" style="background-image: url('{{ url("public/images") }}/{{ $r->image  }}')"></div>
                                                        @else
                                                        <div class="symbol-label" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930')"></div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="{{ url('video') }}/{{ $r->url }}" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $r->name }}</a>
                                                    <span class="text-muted font-weight-bold d-block">Size: {{ $r->filesize }}</span>
                                                </td>
                                                
                                                <td class="text-right">
                                                    <span class="text-muted font-weight-bold d-block">
                                                        Uploaded on
                                                    </span>
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                        {{ Cmf::date_format($r->created_at) }}
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    <span class="text-muted font-weight-bold d-block">
                                                        By
                                                    </span>
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                        Admin
                                                    </span>
                                                </td>
                                                <td class="text-right pr-0">
                                                    <a href="{{ url('admin/videos/edit') }}/{{ $r->id }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                                         <i class="la la-edit"></i> 
                                                    </a>
                                                    <a data-toggle="modal" data-target="#deleteModal{{ $r->id }}" href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                                        <i class="la la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="deleteModal{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <form method="POST" action="{{ url('admin/videos/delete') }}">
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
                                                            Are you Sure you want to Delete this Video?
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
                                            @else

                                                <div class="text-center mt-5" style="font-size:22px">No Videos Found</div>

                                            @endif
                                        </tbody>
                                    </table>
                                    
                                </div>
                                <!--end::Table-->
                                <div style="margin-top:10px;" class="row">
                                    {!! $data->links('frontend.pagination') !!}
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Base Table Widget 7-->
                    </div>
                    <div class="col-md-3">
                        <div class="card card-custom">
                            <!--begin::Header-->
                            <div class="card-header py-3">
                                <div class="card-title align-items-start flex-column">
                                    <h3 class="card-label font-weight-bolder text-dark">Add New</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">Upload New Video</span>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            
                            <form enctype="multipart/form-data" class="form" method="POST" action="{{ url('admin/videos/create') }}">
                                <!--begin::Body-->
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="lable-control">Video Category</label>
                                                <select required class="form-control" name="category_id">
                                                    <option value="">Select Category</option>
                                                    @foreach(DB::table('video_categories')->get() as $r)
                                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="lable-control">Video Title</label>
                                                <input required type="text" class="form-control form-control-md form-control-solid" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="lable-control">Short Description</label>
                                                <textarea name="short_description" required class="form-control form-control-md form-control-solid" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="lable-control">Upload File (mp4)</label>
                                                <input accept=".mp4" type="file" required class="form-control form-control-md form-control-solid" name="video">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="lable-control">Banner Image (png,jpg,jpeg,webp)</label>
                                                <input type="file" class="form-control form-control-md form-control-solid" name="image">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary mr-2">Upload Video</button>
                                        </div>                                                        
                                    </div>  
                                </div>
                                <!--end::Body-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-custom">
                            <!--begin::Header-->
                            <div class="card-header py-3">
                                <div class="card-title align-items-start flex-column">
                                    <h3 class="card-label font-weight-bolder text-dark">Video Categories</h3>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            
                            
                                <div class="card-body">
                                    <form enctype="multipart/form-data" class="form" method="POST" action="{{ url('admin/videos/createcategory') }}">
                                <!--begin::Body-->
                                @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="lable-control">Category Name</label>
                                                <input required type="text" class="form-control form-control-md form-control-solid" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary mr-2">Add New Category</button>
                                        </div>                                                        
                                    </div>
                                    </form>
                                    <br>
                                    <table class="table table-bordered">
                                    @foreach(DB::table('video_categories')->orderby('id' , 'desc')->get() as $r)
                                    <tr>
                                        <td>{{ $r->name }}</td>
                                        <td class="text-right pr-0">
                                            <a data-toggle="modal" data-target="#updateModalcate{{ $r->id }}" href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                                 <i class="la la-edit"></i> 
                                            </a>
                                            <a data-toggle="modal" data-target="#deleteModalcate{{ $r->id }}" href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                                <i class="la la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="updateModalcate{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <form method="POST" action="{{ url('admin/videos/updatecategory') }}">
                                            @csrf
                                        <input type="hidden" value="{{ $r->id }}" name="id">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Category : {{ $r->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="lable-control">Category Name</label>
                                                            <input value="{{ $r->name }}" required type="text" class="form-control form-control-md form-control-solid" name="name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success font-weight-bold">Update Category</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="modal fade" id="deleteModalcate{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <form method="POST" action="{{ url('admin/videos/deletecategory') }}">
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
                                                    Are you Sure you want to Delete this Category if you Delete Category then all Video Will Be Deleted automaticaly against this Category?
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
                                </table>
                                </div>
                                <!--end::Body-->
                            
                            
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
</div>
<!--end::Content-->
@endsection