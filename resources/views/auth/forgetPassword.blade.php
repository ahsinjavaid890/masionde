<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Forget Password</title>
  </head>
  <body>
    

    <!-- main page start here -->
     <section class="signin-sec">
       <div class="container">
         <div class="row">
           <div class="col-md-12">
           
             <div class="signin-card">
                @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                   {{ Session::get('message') }}
               </div>
           @endif
                <h2>Forget Password</h2>
                <p>Enter the valid email</p> 
               

             <form action="{{ route('forget.password.post') }}" method="POST">
                 @csrf
                 <div class="form-group row">
                     <label for="email_address" class="col-md-4 col-form-label ">Email</label>
                     <div class="col-md-12">
                         <input type="text" id="email_address" placeholder="Your E-mail" class="form-control" name="email" required autofocus>
                         @if ($errors->has('email'))
                             <span class="text-danger">{{ $errors->first('email') }}</span>
                         @endif
                     </div>
                 </div>

                 <button type="submit" class="signin-btn">
                    <div class="btn-text">
                        Send Reset Link
                    </div>
                    <div class="btn-icon">
                      <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </div>
                  </button>
               
             </form>
              
               
             </div>
           </div>
         </div>
       </div>
     </section>
    <!-- main page end here -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>






















