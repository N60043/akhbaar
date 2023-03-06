<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign IN</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/mobileViewStyles.css')}}">
    <style type="text/css">
      #responseShow
{
    color: white;
    font-size: 16px;
    background: #a92a40;
    padding: 4px;
    border-radius: 7px;
    display: none;
  }
    </style>
</head>
<body>
<div class="container">
  <div class="col-12" id="MobileUserLogin">
    @if(session()->has('akhbaarNews'))
        <a class="text-decoration-none " href="{{route('akhbaarNews',session()->get('akhbaarNews'))}}">
      @else
         <a class="text-decoration-none " href="{{route('Home-MobileAkhbaar')}}">
      @endif
            <div class="col-1 mt-2 ms-3">
              <i class="fa fa-arrow-left " aria-hidden="true"></i>
            </div>
           </a>
        <div class="col-8 mx-auto border-none" >
        <img src="{{asset('images/default.jpg')}}" width="100%" class="mt-1">
        </div>
      <div class="col-8 mx-auto mt-2" id="akhbaar_Heading">
        MOBILE AKHBAAR
      </div>
          <div class="col-8 mx-auto mt-3">
            <h3 id="signIn_Heading">SIGN IN</h3>
      <p id="enterPhone_paragraph">ENTER YOUR MOBILE NUMBER</p>
          </div>
          <form class="col-8 mx-auto mb-1" action="#">
            @csrf
            <div class="row phone_div ">
              <div class="col-3"  style="display:contents;">
               <i class="fa fa-phone ms-2" aria-hidden="true"></i>
              </div>
              <div class="col-8">
              <input class="phone-InputField" type="number" id="phoneNumber" name="phoneNumber" placeholder="03XX-XXXXXXX" 
               onKeyPress="if(this.value.length==11) return false;" min="0" required>
              </div>
            </div>
            <div class="col-12 mt-2"  id="responseShow" >
           
           </div>
            <div class="row mt-3" style="">
               <button class="otp-Button" id="btn-save">Get OTP</button>
            </div>
         </form>
          <div class="col-9 mx-auto" id="subscription_Container">
             <div class="col-12 d-flex">
               <i class="fa-solid fa-check"></i>
                <p class="subscribing-paragraph ms-1 mt-2" >Subscription charges: Rs. 7 + tax/day</p>
             </div>
            <div class="col-12 d-flex">
               <i class="fa-solid fa-check"></i>
                <p class="subscribing-paragraph ms-1" >By subscribing you are agreeing to daily
              auto renewal charging</p>
             </div>
            <div class="col-12 d-flex">
               <i class="fa-solid fa-check"></i>
                <p class="subscribing-paragraph ms-1" >By subscribing you are agreeing to daily
              auto renewal charging
             </div>
        </div>
        <div class="col-6" style="">
        </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
<!--  CDN for jQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Custom JavascripT for Mobile View -->
<script src="{{asset('Js_News_frontend_pages/mobileViewScript.js')}}"></script>
 <script type="text/javascript">
  $(document).ready(function($){
     $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            phoneNumber: $('#phoneNumber').val()
        };
        var state = $('#btn-save').val();
        var type = "POST";
        // var todo_id = $('#todo_id').val();
        var ajaxurl = '{{route("OTPInsert")}}';
        // var id = ;
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (res) 
            {
             // var jsonData = JSON.stringify(res);
              // var obj = $.parseJSON(res);
              //console.log(res.Message);
              if(res.status == 0){
               window.location.href='{{route("otpMobilePage")}}'
              }
              else if(res.status == 1){
                  const responseDiv = document.getElementById("responseShow");
                responseDiv.style.display="inline-block";
                $('#responseShow').html(res.Error);
              }
             
            },
            error: function (res) 
            {
                console.log(res);
            }
        });
    });

});
</script>
<script type="text/javascript">
  document.getElementById('btn-save').addEventListener('keypress', function(event) {
       
    });
</script>
@extends('Layouts.mobileFooter')
</body>
</html>
