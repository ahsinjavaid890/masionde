@extends('admin.layouts.main-layout')
@section('title','Add New Quiz')

@section('adminbeardcumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/quizzes') }}" class="text-muted">All Quizzes</a>
</li>
<li class="breadcrumb-item">
    <a href="javascript:void(0)" class="text-muted">Add New Quiz</a>
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
                                Add New Quiz
                                <div class="text-muted pt-2 font-size-sm">Step 1/2</div>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="POST" action="{{ url('admin/quizzes/createquiz') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="lable-control">Quiz Title</label>
                                        <input required type="text" class="form-control form-control-md form-control-solid" name="name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="lable-control">Short Description</label>
                                        <textarea name="short_description" class="form-control form-control-md form-control-solid" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="lable-control">Banner Image</label>
                                        <input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control form-control-md form-control-solid" name="image">
                                    </div>
                                </div>
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="lable-control">Quiz Duration (mins)</label>
                                        <input required type="number" class="form-control form-control-md form-control-solid" name="duration">
                                    </div>
                                </div> -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input value="Next" type="submit" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
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