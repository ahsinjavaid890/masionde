@extends('admin.layouts.main-layout')
@section('title','Add Question')

@section('adminbeardcumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/quizzes') }}" class="text-muted">All Quizzes</a>
</li>
<li class="breadcrumb-item">
    <a href="javascript::void(0)" class="text-muted">Add Question</a>
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
                <div class="card card-custom mt-5 ">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                Add Question : {{ $data->name }}
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="accordion accordion-solid accordion-toggle-plus mb-5" id="accordionExample6">
                            @foreach(DB::table('questions')->where('quiz_id' , $data->id)->get() as $r)
                            <div class="card">
                                <div class="card-header" id="headingTwo6">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo{{ $r->id }}">
                                        Question : {{ $r->question }}
                                    </div>
                                </div>
                                <div id="collapseTwo{{ $r->id }}" class="collapse" data-parent="#accordionExample6">
                                    <div class="card-body">
                                        <form id="addquestionform" enctype="multipart/form-data" method="POST"
                                            action="{{ url('admin/quizzes/editquestion') }}">
                                            @csrf
                                            <input type="hidden" value="{{ $r->id }}" name="question_id">
                                            <input type="hidden" value="{{ $r->quiz_id }}" name="quiz_id">
                                            <div class="row">
                                                <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="font-size-h6 font-weight-bolder text-dark">Question
                                                                            Title</label>
                                                                        <input type="text" required
                                                                            class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6"
                                                                            name="question" value="{{ $r->question }}"
                                                                            placeholder="Enter Question" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="prescription-area{{ $r->id }}">
                                                                @php
                                                                $answers = DB::table('answers')->where('question_id' , $r->id)->get()
                                                                @endphp
                                                                @foreach ($answers as $a)
                                                                <div class="row">
                                                                    <div class="col-xl-9">
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <input id="option{{ $a->id }}" name="option[]" value="{{$a->answer}}" type="text" class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6">
                                                                                <div class="input-group-append">
                                                                                    <span id="savecheck{{ $a->id }}" onclick="saveanswer({{$a->id}} , {{$r->id}})" class="btn @if($a->answer) btn-success @else btn-primary @endif" type="button"><i class="fa fa-check"></i></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3">
                                                                        <div class="d-flex justify-content-between">
                                                                            <label class="checkbox checkbox-lg">
                                                                                <input value="{{ $a->id }}" @if ($r->answer_id == $a->id) checked @endif type="radio" name="answer"/> <span></span> &nbsp
                                                                                Answer
                                                                            </label>
                                                                            <div>
                                                                                <span id="removebutton{{ $a->id }}" onclick="removeoption({{ $a->id }} , {{ $r->id }})" class="btn btn-primary btn-sm">Remove</span>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endforeach

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-10 text-right"></div>
                                                                <div class="col-md-2 text-right">
                                                                    <span onclick="addnewoption({{$r->id}})" id="add-prescription{{ $r->id }}" class="btn btn-primary form-control">
                                                                        Add Option
                                                                    </span>
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
                            </div>
                            @endforeach
                        </div>


                        
                        
                        


                        <form id="addquestionform" enctype="multipart/form-data" method="POST" action="{{ url('admin/quizzes/addquestion') }}">
                            @csrf
                            <input type="hidden" value="{{ $data->id }}" name="quiz_id">
                            <input type="hidden" id="type" value="saveandanotherquestion" name="type">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Question {{ DB::table('questions')->where('quiz_id' , $data->id)->count()+1 }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label class="font-size-h6 font-weight-bolder text-dark">Question Title</label>
                                                        <input id="questionid" type="text" required class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6" name="question" placeholder="Eneter Question" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="prescription-area">
                                                <div class="row .w-row">
                                                    <div class="col-xl-10">
                                                        <div class="form-group">
                                                            <input id="optionone" required placeholder="Option 1" type="text" class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6" name="option[]" placeholder=""  />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2">
                                                        <label class="checkbox checkbox-lg">
                                                            <input id="answeroptionone" required type="radio" value="1" name="answer"/>
                                                            <span></span> &nbsp
                                                            Answer
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row .w-row">
                                                    <div class="col-xl-10">
                                                        <div class="form-group">
                                                            <input id="optiontwo" required placeholder="Option 2" type="text" class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6" name="option[]" placeholder=""  />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2">
                                                        <label class="checkbox checkbox-lg">
                                                            <input id="answeroptiontwo" required type="radio" value="2" name="answer"/>
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
                                @if(DB::table('questions')->where('quiz_id' , $data->id)->count() > 0)
                                <div class="col-md-3 mt-3">
                                    <div class="form-group">
                                        <span id="saveandpublishquiz" class="btn btn-primary form-control">Save and Publish Quiz</span>
                                    </div>
                                </div>
                                @endif
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
function removeoption(answerid , questionid) {
    $('#removebutton'+answerid).html('<i class="fa fa-spinner fa-spin"></i>')
    $.ajax({
        type: 'get',
        url: "{{ url('admin/quizzes/removeoption') }}"+'/'+answerid+'/'+questionid,
        success: function(res) {
            $('#prescription-area'+questionid).html(res);
            $('#removebutton'+answerid).html('Remove')
        }
    });
}
function addnewoption(id) {
    $('#add-prescription'+id).html('<i class="fa fa-spinner fa-spin"></i>')
    $.ajax({
        type: 'get',
        url: "{{ url('admin/quizzes/addanswer') }}/"+id,
        success: function(res) {
            $('#prescription-area'+id).append(res);
            $('#add-prescription'+id).html('Add Option')
        }
    });
}
   
    
   

function saveanswer(id , questionid) {
    var value = $('#option'+id).val();
    $.ajax({
        type: 'get',
        url: "{{ url('admin/quizzes/saveanswer') }}"+'/'+value+'/'+id+'/'+questionid,
        success: function(res) {
            $('#prescription-area'+questionid).html(res);
        }
    });
}
</script>
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
        $('#optionone').attr('required' , true);
        $('#optiontwo').attr('required' , true);
        $('#questionid').attr('required' , true);
        $('#answeroptionone').attr('required' , true);
        $('#answeroptiontwo').attr('required' , true);
        $('#submitbutton').click();
    });

    $('#saveandpublishquiz').click(function(){
        $('#type').val('saveandpublishquiz');
        $('#optionone').attr('required' , false);
        $('#optiontwo').attr('required' , false);
        $('#questionid').attr('required' , false);
        $('#answeroptionone').attr('required' , false);
        $('#answeroptiontwo').attr('required' , false);
        $('#submitbutton').click();
    });
});
</script>
@endsection