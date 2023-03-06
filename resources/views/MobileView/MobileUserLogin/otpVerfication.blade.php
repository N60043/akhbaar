<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OTP Verification</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/mobileViewStyles.css')}}">
    <style type="text/css">
      #resend_Button
      {
        display: none;
      }
    </style>
</head>
<body>
<div class="container">
    <div class="col-12" id="MobileUserLogin">
      <a class="text-decoration-none " href="{{url()->previous()}}">
        <div class="col-1 mt-2 ms-3">
          <i class="fa fa-arrow-left " aria-hidden="true"></i>
        </div>
      </a>
        @if (Session::has('error'))
            <div class="col-8 mx-auto mt-4 alert alert-danger alert-dismissible" role="alert">
               <!--  <button type="button" class="btn-close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button> -->
                <strong style="font-size:12px">Error !  {{ session('error') }}</strong>
            </div>
        @endif
        <div class="col-8 mx-auto border-none" >
        <img src="{{asset('images/default.jpg')}}" width="100%" class="mt-4">
      </div>
      <div class="col-8 mx-auto mt-2" id="akhbaar_Heading">
        MOBILE AKHBAAR
      </div>
          <div class="col-8 mx-auto mt-4">
            <h3 id="confirmation_Heading">Confirmation</h3>
      <p id="enterPhone_paragraph">Enter Confirmation Code</p>
          </div>
        <form method="post" action="{{route('OTPVerifying')}}" class="otpVerification_form col-8 mx-auto">
            @csrf
            <div class="d-flex  mt-2 ml-3" id="otp_mainContainer">
              <div class="OTP_div " >
              <input class="OTP-InputField" id="otp-InputField" type="number" name="digit1" placeholder="X" maxlength="1"
               onKeyPress="if(this.value.length==1) return false;" min="0" required>
              </div>
              <div class="OTP_div ms-3" >
              <input class="OTP-InputField" id="otp-InputField"type="number" name="digit2" placeholder="X"  maxlength="1"
               onKeyPress="if(this.value.length==1) return false;" min="0" required>
              </div>
              <div class="OTP_div ms-3" >
              <input class="OTP-InputField" id="otp-InputField" type="number" name="digit3" placeholder="X"  maxlength="1"
               onKeyPress="if(this.value.length==1) return false;" min="0" required>
              </div>
              <div class="OTP_div ms-3" >
              <input class="OTP-InputField" id="otp-InputField" type="number" name="digit4" placeholder="X"  maxlength="1"
               onKeyPress="if(this.value.length==1) return false;" min="0" required>
              </div>
            </div>
             <div class="col-12 mx-auto mt-3" >
              <p class="text-center" id="timeout_OTP" >Resend OTP in <span id="timer"></span> seconds</p>
            </div>
            <div class="col-12 d-flex mx-auto mt-1" >
               <button id="resend_Button" >RESEND</button>
                <button class="ms-4" id="confirm_Button" type="submit" style="margin-left: 5rem !important;">CONFIRM</button>
            </div>
          </form>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
<!--  CDN for jQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Custom JavascripT for Mobile View -->
<script src="{{asset('Js_News_frontend_pages/mobileViewScript.js')}}"></script>
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
      const resendButton = document.getElementById("resend_Button");
      resendButton.style.display="inline-block";
       document.getElementById('timeout_OTP').innerHTML = "If you want to Resend OTP Please Enter Resend Button.";
       $('#resend_Button').click(function (e)
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
  $(".OTP-InputField").keyup(function() {
  if (this.value.length == this.maxLength) {
  $(this)
    .blur()
    .parent()
    .next()
    .children('.OTP-InputField')
    .focus();
  }

  });

</script>
@extends('Layouts.mobileFooter')