@extends('frontend.layouts.main')
@section('tittle')
<title>Dashboard</title>
@endsection
@section('content')
<section class="pop-up-sec">
  <div class="text-center"><img src="https://i.gifer.com/origin/34/34338d26023e5515f6cc8969aa027bca_w200.gif"></div>
</section>
<script type="text/javascript">
function selectoption(id , question) {
    $('.select-btn').removeClass('active');
    $('#selectoption'+id).addClass('active');
    $('#slectedoption').val(id);
    $('#question').val(question);
    $('.validityerror').hide();
}
$( document ).ready(function() {
    $.ajax({
        type: 'get',
        url: "{{ url('quiz/getuserquiz') }}/{{ $data->id }}",
        success: function(res) {
            $('.pop-up-sec').html(res);
        }
    });
});


function nextbutton() {
  var value = $('#slectedoption').val();
  var question = $('#question').val();
  if(value)
  {
    $.ajax({
        type: 'get',
        url: "{{ url('quiz/savequiz') }}/{{ $data->id }}/"+value+'/'+question,
        success: function(res) {
          $('.pop-up-sec').html(res);
        }
    });
  }else{
    $('.validityerror').html('Please Select Atleast One Option');
  }
}
</script>
@endsection