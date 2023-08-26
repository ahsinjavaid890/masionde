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
                                Edit Question of Quiz: {{ DB::table('quizzes')->where('id' , $data->quiz_id)->first()->name }}
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="addquestionform" enctype="multipart/form-data" method="POST" action="{{ url('admin/quizzes/editquestion') }}">
                        @csrf
                        <input type="hidden" value="{{ $data->id }}" name="question_id">
                        <input type="hidden" value="{{ $data->quiz_id }}" name="quiz_id">
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
                                                        name="question" value="{{ $data->question }}"
                                                        placeholder="Enter Question" />
                                                </div>
                                            </div>
                                        </div>
                                        <div id="prescription-area{{ $data->id }}">
                                            @php
                                            $answers = DB::table('answers')->where('question_id' , $data->id)->get()
                                            @endphp
                                            @foreach ($answers as $a)
                                            <div class="row">
                                                <div class="col-xl-9">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input id="option{{ $a->id }}" name="option[]" value="{{$a->answer}}" type="text" class="form-control form-control-solid h-auto p-5 border-0 rounded-lg font-size-h6">
                                                            <div class="input-group-append">
                                                                <span id="savecheck{{ $a->id }}" onclick="saveanswer({{$a->id}} , {{$data->id}})" class="btn @if($a->answer) btn-success @else btn-primary @endif" type="button"><i class="fa fa-check"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3">
                                                    <div class="d-flex justify-content-between">
                                                        <label class="checkbox checkbox-lg">
                                                            <input value="{{ $a->id }}" @if ($data->answer_id == $a->id) checked @endif type="radio" name="answer"/> <span></span> &nbsp
                                                            Answer
                                                        </label>
                                                        <div>
                                                            <span id="removebutton{{ $a->id }}" onclick="removeoption({{ $a->id }} , {{ $data->id }})" class="btn btn-primary btn-sm">Remove</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 text-right"></div>
                                            <div class="col-md-2 text-right">
                                                <span onclick="addnewoption({{$data->id}})" id="add-prescription{{ $data->id }}" class="btn btn-primary form-control">
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
@endsection