<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Plan and Subscription</title>
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
  <div class="container" style="overflow: auto;height: 49rem;">
   <div class="col-8 mx-auto mt-4" id="copyright_Container">
    <div class="col-8 mx-auto border-danger mt-3" >
      <img src="{{asset('images/default.jpg')}}" width="100%" class="mt-4">
    </div>
    <div class="col-8 mx-auto mt-2" id="akhbaar_Heading">MOBILE AKHBAAR</div>
    <div class="col-8 mx-auto mt-2" id="copyright_Content">
      <p class="text-center">Version 0.1.84</p>
      <p class="">Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2023 Idetion.</p>
      <p class="text-center">All rights reserved.</p>

    </div>
  </div>
  <div class="col-12 d-flex mt-2 text-center pb-2" id="planandsubscription_HeaderConatiner">
    <a class="text-decoration-none " href="{{route('ViewSetting')}}">
      <div class="col-1 mt-1 ms-3" id="planandsubscription_Header">
        <i class="fa fa-arrow-left " aria-hidden="true"></i>
      </div>
    </a>
    <div class="col-11">
     <strong >Plan And Subscription</strong>
    </div>
  </div>
<div class="col-12 mt-2"  id="responseShow" >
      </div>
  <div class="planandsunbscription_Container d-flex overflow-auto" >
      <div class="col-10 mx-auto mt-5" id="subscription_ContentContainer">
        <div class="col-10 mx-auto mt-3" id="weeklypackage_Header">
          <p>Weekly Package </p>
        </div>
        <div class="col-10 mx-auto mt-3" id="weeklypackage_Content">
          <h1 class="text-danger">Rs 7/week </h1>
        </div>
        <div class="col-7 d-flex mx-auto">
          <i class="fa fa-database" aria-hidden="true"></i>
          <p class="ms-1">Rs.7 inclusive of Tax.</p>
        </div>
        <div class="col-7 d-flex mx-auto">
          <i class="fa fa-database" aria-hidden="true"></i>
          <p class="ms-1 ">By subscribing you are agreeing to weekly auto renewal charging.</p>
        </div>
        <div class="col-7 d-flex mx-auto">
          <i class="fa fa-database" aria-hidden="true"></i>
          <p class="ms-1">By subscribing you are agreeing to our term & conditions and privacy policy.</p>
        </div>
        @if(session()->get('loginUser_subscriptionPlan')==2)
        <div class="col-7 d-flex mx-auto" id="unSubscribe_Container">
          <a type="button" id="unSubscribe" class="btn btn-danger">UN-SUBSCRIBE</a>
        </div>
        @else
        <div class="col-7 d-flex mx-auto " id="reniewSubscribe_Container">
            <a type="button" id="a" class="btn btn-danger">RENEW SUBSCRIPTION</a>
        </div>
        @endif
	  
      </div>
      <!-- <div class="col-10 mx-auto mt-5 ms-5" id="subscription_ContentContainer">
        <div class="col-10 mx-auto mt-3" id="weeklypackage_Header">
          <p>Weekly Package </p>
        </div>
        <div class="col-10 mx-auto mt-3" id="weeklypackage_Content">
          <h1 class="text-danger">Rs 7/week </h1>
        </div>
        <div class="col-7 d-flex mx-auto">
          <i class="fa fa-database" aria-hidden="true"></i>
          <p class="ms-1">Rs.7 inclusive of Tax.</p>
        </div>
        <div class="col-7 d-flex mx-auto">
          <i class="fa fa-database" aria-hidden="true"></i>
          <p class="ms-1 ">By subscribing you are agreeing to weekly auto renewal charging.</p>
        </div>
        <div class="col-7 d-flex mx-auto">
          <i class="fa fa-database" aria-hidden="true"></i>
          <p class="ms-1">By subscribing you are agreeing to our term & conditions and privacy policy.</p>
        </div>
        <div class="col-7 d-flex mx-auto" id="sub_buttons">
          <a type="button" class="btn btn-danger">SUBSCRIBE</a>
        </div>
         <div class="col-7 d-flex mx-auto " id="sub_buttons">
            <a type="button" class="btn btn-danger">RENEW SUBSCRIPTION</a>
        </div>
      </div> -->
    </div>

 
</div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
<!--  CDN for jQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Custom JavascripT for Mobile View -->
<script src="{{asset('Js_News_frontend_pages/mobileViewScript.js')}}"></script>
@extends('Layouts.mobileFooter')
<script type="text/javascript">
  $(document).ready(function($){
      var id='{{session()->get("loginUser")}}';
      const responseDiv = document.getElementById("responseShow");
    $("#unSubscribe").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var ajaxurl = '{{ route("userUnsubscribe",":id") }}';
        url = ajaxurl.replace(':id', id);
        var type = "POST";
        // var id = ;
        $.ajax({
            type: type,
            url: url,
            dataType: 'json',
            success: function (res) {
               if(res.status==0)
               {
                 responseDiv.style.display="inline-block";
                 $('#responseShow').html('Error accur While Unsubscribed');
                 setTimeout(function () {
                    history.go(0);
                  }, 3000);
                location.reload();
               }
               if(res.status==1)
               {
                 responseDiv.style.display="inline-block";
                 $('#responseShow').html('You are successfully Unsubcribed');
                 setTimeout(function () {
                    history.go(0);
                  }, 3000);

                location.reload();
               }
            },
            error: function (res) {
                console.log(res);
				 //location.reload();

            }
        });
    });


// Reniew Subscreption//

     $("#reniewSubscribe_Container").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var ajaxurl = '{{ route("reniew_Subsribtion",":id") }}';
        url = ajaxurl.replace(':id', id);
        var type = "POST";
        // var id = ;
        $.ajax({
            type: type,
            url: url,
            dataType: 'json',
            success: function (res) {
			      if(res.status==0)
               {
                 responseDiv.style.display="inline-block";
                 $('#responseShow').html('Please Recharge Account to enjoy this Service');
                 setTimeout(function () {
                    history.go(0);
                  }, 3000);
               }
               if(res.status==1)
               {
                 responseDiv.style.display="inline-block";
                 $('#responseShow').html('You are successfully Charged');
                 setTimeout(function () {
                    history.go(0);
                  }, 3000);
               }
            },
            error: function (res) {
                console.log(res);
            }
        });
    });
});

</script>
</body>
</html>