@extends('admin.layouts.main-layout')
@section('title','Add Question')

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
                                Add Question : {{ $data->name }}
                                <div class="text-muted pt-2 font-size-sm">Step 2/2</div>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="addquestionform" enctype="multipart/form-data" method="POST" action="{{ url('admin/quizzes/addquestion') }}">
                            @csrf
                            <input type="hidden" value="{{ $data->id }}" name="quiz_id">
                            <input type="hidden" id="type" value="saveandanotherquestion" name="type">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Question 1</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label class="font-size-h6 font-weight-bolder text-dark">Question Title</label>
                                                        <input type="text" required class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6" name="question" placeholder="Eneter Question" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="prescription-area">
                                                <div class="row .w-row">
                                                    <div class="col-xl-10">
                                                        <div class="form-group">
                                                            <input required placeholder="Option 1" type="text" class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6" name="option[]" placeholder=""  />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2">
                                                        <label class="checkbox checkbox-lg">
                                                            <input type="radio" value="1" name="answer"/>
                                                            <span></span> &nbsp
                                                            Answer
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <div class="row">
                                                <div class="col-md-8 text-right"></div>
                                                <div class="col-md-2 text-right">
                                                    <span id="remove-prescription" class="btn btn-primary form-control">
                                                        Remove Last
                                                    </span>
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <span id="add-prescription" class="btn btn-primary form-control">
                                                        Add Option
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <div class="form-group">
                                        <button type="submit" style="display: none;" id="submitbutton"></button>
                                        <span id="saveandanotherquestion" class="btn btn-primary form-control">Save and Add Another Question</span>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <div class="form-group">
                                        <span id="saveandpublishquiz" class="btn btn-primary form-control">Save and Publish Quiz</span>
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
<script type="text/javascript">
    $(document).ready(function() {
    $('#add-prescription').click(function(){
        var intId = $("#prescription-area .w-row").length + 2 || 1;
        var presFields = $('<div class="row w-row"> <div class="col-xl-10"> <div class="form-group"> <input placeholder="Option '+intId+'" name="option[]" type="text" required class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6" placeholder=""  /> </div> </div> <div class="col-xl-2"> <label class="checkbox checkbox-lg"> <input type="radio" value="'+intId+'" name="answer"/> <span></span> &nbsp Answer </label> </div> </div>');
        $('#prescription-area').append(presFields);
    });
    $('#remove-prescription').click(function(){
        $("#prescription-area .w-row:last").remove();
    });

    $('#saveandanotherquestion').click(function(){
        $('#type').val('saveandanotherquestion');
        $('#submitbutton').click();
    });

    $('#saveandpublishquiz').click(function(){
        $('#type').val('saveandpublishquiz');
        $('#submitbutton').click();
    });
});
</script>
@endsection