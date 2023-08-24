@extends('admin.layouts.main-layout')
@section('title','Edit Question')

@section('adminbeardcumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/quizzes') }}" class="text-muted">All Quizzes</a>
</li>
<li class="breadcrumb-item">
    <a href="javascript:void(0)" class="text-muted">Edit Question</a>
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
                                Edit Question : {{ DB::table('quizzes')->where('id' , $data->quiz_id)->first()->name }}
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="addquestionform" enctype="multipart/form-data" method="POST"
                            action="{{ url('admin/quizzes/editquestion') }}">
                            @csrf
                            <input type="hidden" value="{{ $data->id }}" name="question_id">
                            <input type="hidden" value="{{ $data->quiz_id }}" name="quiz_id">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Question {{ DB::table('questions')->where('quiz_id' ,
                                                $data->id)->count()+1 }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label
                                                            class="font-size-h6 font-weight-bolder text-dark">Question
                                                            Title</label>
                                                        <input type="text" required
                                                            class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6"
                                                            name="question" value="{{ $data->question }}"
                                                            placeholder="Enter Question" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="prescription-area">
                                                @php
                                                $answers = DB::table('answers')->where('question_id' , $data->id)->get()
                                                @endphp
                                                @foreach ($answers as $a)
                                                <div class="row .w-row">
                                                    <div class="col-xl-9">
                                                        <div class="form-group">
                                                            <input type="hidden" value="{{$a->id}}" name="previous_id[]">
                                                            
                                                            <input required placeholder="Option 1" type="text"
                                                                class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6"
                                                                name="option[]" placeholder="" value="{{$a->answer}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3">
                                                        
                                                        <div class="d-flex justify-content-between">
                                                            <label class="checkbox checkbox-lg">
                                                                <input @if ($data->answer_id == $a->id)
                                                                checked
                                                                @endif
                                                                type="radio" value="{{$a->id}}" name="answer"/>
                                                                <span></span> &nbsp
                                                                Answer
                                                            </label>
                                                            <div>
                                                                <a href="{{url('admin/quizzes/deleteanswer')}}/{{$a->id}}" class="btn btn-primary btn-sm">Remove</a>
                                                               
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                @endforeach

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
                                        <button type="submit" class="btn btn-primary">Update</button>

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
        var presFields = $('<div class="row w-row"> <div class="col-xl-9"> <div class="form-group"> <input placeholder="Option '+intId+'" name="option[]" type="text" required class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6" placeholder="" /> </div> </div> <div class="col-xl-3"> <label class="checkbox checkbox-lg"> <input type="radio" value="'+intId+'" name="answer"/> <span></span> &nbsp Answer </label> </div> </div>');
        $('#prescription-area').append(presFields);
    });
    $('#remove-prescription').click(function(){
        $("#prescription-area .w-row:last").remove();
    });

   

    
});
</script>
@endsection