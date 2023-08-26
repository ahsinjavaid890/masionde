@extends('admin.layouts.main-layout')
@section('title','All Questions')

@section('adminbeardcumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/quizzes') }}" class="text-muted">All Quizzes</a>
</li>
<li class="breadcrumb-item">
    <a href="javascript:void(0)" class="text-muted">Add Question</a>
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
                                View Quiz : {{ $data->name }}
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-separate table-head-custom table-checkable" id="userTable">
                            <thead>
                                <tr>
                                    <th scope="col">Question Title</th>
                                    <th scope="col">Answers</th>
                                    <th scope="col">Correct Answer</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(DB::table('questions')->where('quiz_id' , $data->id)->orderby('id' , 'asc')->get() as $r)
                                <tr class="align-items-center">
                                    <td class="sorting_1 dtr-control">
                                        {{ $r->question }}
                                    </td>
                                
                                   
                                    <td>{{ DB::table('answers')->where('question_id' , $r->id)->count() }}</td>
                                    <td>{{ DB::table('answers')->where('id' , $r->answer_id)->first()->answer }}</td>
                                    <td nowrap="">
                                        <a href="{{url('admin/quizzes/editquestion')}}/{{$r->id}}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                             <i class="la la-edit"></i> 
                                        </a>
                                        <a data-toggle="modal" data-target="#deleteModal{{ $r->id }}" href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deleteModal{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form method="POST" action="{{ url('admin/quizzes/deletequestion') }}">
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
                                @endforeach
                            </tbody>
                        </table>
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