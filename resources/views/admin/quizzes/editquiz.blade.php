@extends('admin.layouts.main-layout')
@section('title','Update Quizz')
@section('adminbeardcumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/quizzes') }}" class="text-muted">All Quizzes</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ url('admin/quizzes') }}" class="text-muted">Edit quizz : {{ $data->name }}</a>
</li>
@endsection
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
           @include('alerts.index')
           <form enctype="multipart/form-data" method="POST" action="{{ url('admin/quizzes/updatequiz') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label">
                            Update Quizz
                            <div class="text-muted pt-2 font-size-sm">Update quizze</div>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                	<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="lable-control">Quiz
                                    Title</label>
                                <input value="{{ $data->name }}" required type="text" class="form-control form-control-md form-control-solid" name="name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="lable-control">Short
                                    Description</label>
                                <textarea name="short_description" class="form-control form-control-md form-control-solid" rows="3">{{ $data->short_description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="lable-control">Banner
                                    Image</label>
                                <input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control form-control-md form-control-solid" name="image">
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
                            <div class="form-group">
                                <label class="lable-control">Quiz Duration
                                    (mins)</label>
                                <input required type="number" value="{{ $data->duration }}" class="form-control form-control-md form-control-solid" name="duration">
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="lable-control">Quiz
                                    Status</label>
                                <select class="form-control" name="status">
                                    <option @if ($data->status == 'In Active') selected @endif
                                        value="In Active">In Active
                                    </option>
                                    <option @if ($data->status == 'Active') selected @endif
                                        value="Active">Active</option>
                                </select>
                            </div>
                        </div>
                    <div class="form-group">
                        <input type="submit" value="Update Quizz" class="btn btn-primary" placeholder="Password">
                    </div>
                </div>
            </div>
            </form>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->

<!-- Modal-->
@endsection
