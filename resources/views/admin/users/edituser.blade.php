@extends('admin.layouts.main-layout')
@section('title','Update User')
@section('adminbeardcumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/users') }}" class="text-muted">All Users</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ url('admin/users') }}" class="text-muted">Edit User : {{ $data->name }}</a>
</li>
@endsection
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
           @include('alerts.index')
           <form method="post" action="{{ url('admin/users/edituser') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label">
                            Update User
                            <div class="text-muted pt-2 font-size-sm">Update Agent</div>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                	<div class="form-group">
                        <label>Select Status</label>
                        <select required name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="active" @if($data->status == 'active') selected @endif>Active</option>
                            <option value="inactive" @if($data->status == 'inactive') selected @endif>In Active</option>
                        </select>
                    </div>
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input required value="{{  $data->name }}" type="text" name="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Profile Image</label>
                                <input type="file" name="profileimage" class="form-control" placeholder="Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input required value="{{  $data->email }}" type="email" name="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input required value="{{  $data->phonenumber }}" type="number" name="phonenumber" class="form-control" placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                        <label>Little About Me</label>
                        <textarea class="form-control" name="about_me" rows="3" placeholder="Write Something About You.....">{{  $data->name }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Account Password</label>
                        <input type="password" name="password" class="form-control" autocomplete="false"  placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update User" class="btn btn-primary" placeholder="Password">
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