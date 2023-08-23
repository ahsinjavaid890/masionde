@extends('frontend.layouts.main')
@section('tittle')
<title>Dashboard</title>
@endsection
@section('content')
<section class="pop-up-sec">
 <div class="container">
   <div class="row">
     <div class="col-md-12">
     <div class="pop-up-div">
       <div class="row">
         <div class="col-md-12 pop-up-logo">
           <img src="{{ url('public/assets/images/logo.png') }}" class="img-fluid">
           <div class="cross-icon">
             <i class="fa fa-times" aria-hidden="true"></i>
           </div>
         </div>      
       </div>
       <div class="row mb-4">
         <div class="col-md-12">
           <div class="my-bar">
           <div class="main-outer">
           <div class="progress-bar">
             <div class="progress-container">
              <div class="progress-bar"></div>
          </div>
           </div>
         </div>
         <p>1/{{ DB::table('questions')->where('quiz_id' , $data->id)->count() }}</p>
         </div>
         </div>
       </div>
     </div>
   </div>
   </div>
   <div class="row">
     <div class="col-md-12">
      <div id="showquiz">
        <div class="text-center">
          <img src="https://i.gifer.com/origin/34/34338d26023e5515f6cc8969aa027bca_w200.gif">
        </div>
      </div>
       <input type="hidden" id="slectedoption">
       <input type="hidden" id="question">
       
       <div class="main-btn-outer">
         <div class="left-btns-div">
           <a style="display: none;" href="javascript:void(0)" class="back-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M9.56994 18.8201C9.37994 18.8201 9.18994 18.7501 9.03994 18.6001L2.96994 12.5301C2.67994 12.2401 2.67994 11.7601 2.96994 11.4701L9.03994 5.40012C9.32994 5.11012 9.80994 5.11012 10.0999 5.40012C10.3899 5.69012 10.3899 6.17012 10.0999 6.46012L4.55994 12.0001L10.0999 17.5401C10.3899 17.8301 10.3899 18.3101 10.0999 18.6001C9.95994 18.7501 9.75994 18.8201 9.56994 18.8201Z" fill="url(#paint0_linear_82_46)"/>
          <path d="M20.4999 12.75H3.66992C3.25992 12.75 2.91992 12.41 2.91992 12C2.91992 11.59 3.25992 11.25 3.66992 11.25H20.4999C20.9099 11.25 21.2499 11.59 21.2499 12C21.2499 12.41 20.9099 12.75 20.4999 12.75Z" fill="url(#paint1_linear_82_46)"/>
          <defs>
            <linearGradient id="paint0_linear_82_46" x1="6.53494" y1="5.18262" x2="6.53494" y2="18.8201" gradientUnits="userSpaceOnUse">
              <stop stop-color="#24272C"/>
              <stop offset="1" stop-color="#202326"/>
            </linearGradient>
            <linearGradient id="paint1_linear_82_46" x1="12.0849" y1="11.25" x2="12.0849" y2="12.75" gradientUnits="userSpaceOnUse">
              <stop stop-color="#24272C"/>
              <stop offset="1" stop-color="#202326"/>
            </linearGradient>
          </defs>
          </svg> Back</a>
          </div>
          <div class="right-btns-div">
            <a id="nextButton" href="javascript:void(0)"><span>Next</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M14.4301 18.8201C14.2401 18.8201 14.0501 18.7501 13.9001 18.6001C13.6101 18.3101 13.6101 17.8301 13.9001 17.5401L19.4401 12.0001L13.9001 6.46012C13.6101 6.17012 13.6101 5.69012 13.9001 5.40012C14.1901 5.11012 14.6701 5.11012 14.9601 5.40012L21.0301 11.4701C21.3201 11.7601 21.3201 12.2401 21.0301 12.5301L14.9601 18.6001C14.8101 18.7501 14.6201 18.8201 14.4301 18.8201Z" fill="white"/>
            <path d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z" fill="white"/>
          </svg></a>
          </div>
       </div>
     </div>
   </div>
 </div>
</section>
<script type="text/javascript">
function selectoption(id , question) {
    $('.select-btn').removeClass('active');
    $('#selectoption'+id).addClass('active');
    $('#slectedoption').val(id);
    $('#question').val(question);
}
$( document ).ready(function() {
    $.ajax({
        type: 'get',
        url: "{{ url('quiz/getuserquiz') }}/{{ $data->id }}",
        success: function(response) {
            $('#showquiz').html(response);
        }
    });
});
$('#nextButton').click(function(){
    var value = $('#slectedoption').val();
    var question = $('#question').val();
    if(value)
    {
      $.ajax({
          type: 'get',
          url: "{{ url('quiz/savequiz') }}/{{ $data->id }}/"+value+'/'+question,
          success: function(response) {
            $('#showquiz').html(response);
          }
      });
    }
});
</script>
@endsection