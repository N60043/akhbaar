 @include('Layouts.header')
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Plan and Subscription</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
<body style="background: black !important;">
    <h4 class="font-weight-bolder ml-3 mt-3 ps-3" id="profile_heading">Plan and Subscreption</h4>
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 col-12 mt-2 mx-auto"  id="responseShow" >
          
      </div>
  <div class="col-xl-4 col-lg-6 col-md-7 col-sm-8 col-12 mx-auto planandsunbscription_Container d-flex overflow-auto" >
      <div class="col-10 mx-auto mt-5" id="subscription_ContentContainer">
        <div class="col-10 mx-auto mt-3" id="weeklypackage_Header">
          <p>Weekly Package </p>
        </div>
        <div class="col-10 mx-auto mt-3" id="weeklypackage_Content">
          <h1 class="text-danger">Rs 7/week </h1>
        </div>
        <div class="col-7 d-flex mx-auto">
          <i class="fa fa-database" aria-hidden="true"></i>
          <p class="ml-1">Rs.7 inclusive of Tax.</p>
        </div>
        <div class="col-7 d-flex mx-auto">
          <i class="fa fa-database" aria-hidden="true"></i>
          <p class="ml-1 ">By subscribing you are agreeing to weekly auto renewal charging.</p>
        </div>
        <div class="col-7 d-flex mx-auto">
          <i class="fa fa-database" aria-hidden="true"></i>
          <p class="ml-1">By subscribing you are agreeing to our term & conditions and privacy policy.</p>
        </div>
        @if(session()->get('loginUser_subscriptionPlan_Web')==2)
        <div class="col-7 d-flex mx-auto" id="unSubscribe_Container">
          <a type="button"  class="btn btn-danger">UN-SUBSCRIBE</a>
        </div>
        @else
        <div class="col-7 d-flex mx-auto " id="reniewSubscribe_Container">
            <a type="button" class="btn btn-danger">RENEW SUBSCRIPTION</a>
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
<script type="text/javascript">
  $(document).ready(function($){
    const id='{{$currentWebUSer}}';
         const responseDiv = document.getElementById("responseShow");
    $("#unSubscribe_Container").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var ajaxurl = '{{ route("Unsubscribed_webUser",":id") }}';
        url = ajaxurl.replace(':id', id);
        var type = "POST";
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

// Reniew Subscreption///

     $("#reniewSubscribe_Container").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var ajaxurl = '{{route("reniew_SubsPlan",":id")}}';
        url = ajaxurl.replace(':id', id);
        var type = "POST";
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

@include('Layouts.footer')