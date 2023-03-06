<!DOCTYPE html>
<html >
<head>
  <title>Verification</title>
  <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/styles.css')}}"> 
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- CDN for Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--  CDN for jQUERY -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style type="text/css">
     @media screen and (max-width:1199px) and (min-width::992px)
    {
     .timeOut-Otp
     {
      margin-left: 2rem !important;
     }
     .verify-Button 
     {
      margin-left: 4rem !important;
     }
    }
    @media screen and (max-width:991px) and (min-width:300px)
    {
     #otp_mainContainer
     {
      width: 17rem !important;
     }
     .timeOut-Otp
     {
      width: 20rem !important;
      margin-left: -0.5rem !important;
     }
     .verify-Button
     {
      margin-left: 4rem !important;
     }
    }
    #resendButton
    {
      display: none;
      background: grey;
    }
  </style>
</head>
<body style="background-color: black;">
  @include('Layouts.header')
  <div class="container-fluid" style="background-image: url('{{ asset('images/loginbg.webp')}}');background-size: cover;height: 100vh;">
    <div class="container"  style="width: 100%;">
      <div class="main-content d-flex " >
        <div class="col-6" style="color: white;">
          <div class="row ml-4">
            <h4 class="ml-3">OTP Verification</h4>
          </div>
          @if (Session::has('success'))
            <div class="col-6 ml-2 alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <strong style="font-size:12px">Success !  {{ session('success') }}</strong>
            </div>
        @endif

        @if (Session::has('error'))
            <div class="col-6 ml-2 alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <strong style="font-size:12px">Error ! {{ session('error') }}</strong> 
            </div>
        @endif
          <form method="post" action="{{route('VerifyOTP')}}">
            @csrf
            <div class="row d-flex  mt-2 ml-3" id="otp_mainContainer">
              <div class="OTP_div ml-3">
              <input class="phone-InputField" id="Otp-InputField" type="number" name="digit1" placeholder="X"   maxlength="1"
               onKeyPress="if(this.value.length==1) return false;" min="0" required>
              </div>
              <div class="OTP_div ml-2" >
              <input class="phone-InputField" id="Otp-InputField" type="number" name="digit2" placeholder="X"  maxlength="1"
               onKeyPress="if(this.value.length==1) return false;" min="0" required>
              </div>
              <div class="OTP_div ml-2">
              <input class="phone-InputField" id="Otp-InputField" type="number" name="digit3" placeholder="X"  maxlength="1" 
              onKeyPress="if(this.value.length==1) return false;" min="0" required>
              </div>
              <div class="OTP_div ml-2">
              <input class="phone-InputField" id="Otp-InputField" type="number" name="digit4" placeholder="X"  maxlength="1"
               onKeyPress="if(this.value.length==1) return false;" min="0" required>
              </div>
            </div>
            <div class="row mt-1" >
              <p class="timeOut-Otp" id="timeout_OTP" >Resend OTP in <span id="timer"></span> seconds</p>
            </div>
            <div class="row mt-1 d-flex" style="">
              <button class="verify-Button col-xl-2 col-lg-2 col-sm-3 p-2" id="resendButton" type="submit">Resend</button>
              <button class="verify-Button col-xl-2 col-lg-2  col-sm-3 p-2" type="submit" sty>Confirm</button>
            </div>
          </form>
        </div>
      </div>
  </div>
 <!-- Custom Javascript -->
    <script src="{{asset('Js_News_frontend_pages/script.js')}}"></script>
    <script type="text/javascript">
      
$(document).ready(function() {
let timerOn = true;
function timer(remaining) {
  var m = Math.floor(remaining / 120);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {

  }
  
  // Do timeout stuff here
 const resendButton = document.getElementById("resendButton");
      resendButton.style.display="inline-block";
       document.getElementById('timeout_OTP').innerHTML = "If you want to Resend OTP Please Enter Resend Button.";
         $('#resendButton').click(function (e)
       {
           $.ajaxSetup(
           {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
            e.preventDefault();
            history.back();
          });
}

timer(60);
});

    </script>
    <script type="text/javascript">
      $(".phone-InputField").keyup(function() {
  if (this.value.length == this.maxLength) {
    $(this)
      .blur()
      .parent()
      .next()
      .children('.phone-InputField')
      .focus();
  }
  
});
</script>
</body>
</html>