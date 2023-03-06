<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Setting</title>
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/mobileViewStyles.css')}}">
</head>
<body>
<div class="setting_Container ms-3">
		  <h1 class="mt-2" id="heading_Setting">Setting</h1>
		</div>
	<div class="col-12" id="setting_subContainer">
		@if(session()->has('currentUser_MobileApp'))
		<a href="{{route('ViewProfile')}}" class="text-decoration-none" >
			<div class="col-11 d-flex" id="items">
					<div class="col-1" id="item_Icon">
						<i class="fa fa-user" aria-hidden="true"></i>
					</div>
					<div class="col-4 ms-2" id="icon_heading">My Profile</div>
			</div>
	  </a>
	    <a href="{{route('planandsubscription')}}" class="text-decoration-none">
			<div class="col-11 d-flex" id="items">
					<div class="col-1" id="item_Icon">
						<i class="fa fa-subscript" aria-hidden="true"></i>
					</div>
					<div class="col-4 ms-2" id="icon_heading">Plan and Subscription</div>
			</div>
	    </a>
	  @endif
			<!-- <div class="col-11 d-flex" id="items">
					<div class="col-1" id="item_Icon">
						<i class="fa fa-star" aria-hidden="true"></i>
					</div>
					<div class="col-4 ms-2" id="icon_heading">Night Mode</div>
					<div class="col-7 d-flex justify-content-end form-check form-switch">
					   <div class="form-check form-switch mt-1">
							  <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
						</div>
					</div>
			</div> -->
     <!-- <script type="text/javascript">
				document.getElementById("flexSwitchCheckChecked").addEventListener("change", function() {
  if (document.getElementById("flexSwitchCheckChecked").checked == true) {
    document.getElementsByTagName("body")[0].setAttribute("style", "background: white !important;color:black !important;");
    document.getElementById('icon_heading').style.color = "black ";

  } else {
    document.documentElement.setAttribute("style", "background-color: black !important;");
    document.getElementsByTagName("div")[0].setAttribute("style", "color: white !important;");
  }
});
			</script> -->
		
	    <a href="{{route('termandcondition')}}" class="text-decoration-none">
			<div class="col-11 d-flex" id="items">
					<div class="col-1" id="item_Icon">
						<i class="fa fa-file-text" aria-hidden="true"></i>
					</div>
					<div class="col-4 ms-2" id="icon_heading">Term and Condition</div>
			</div>
	    </a>
	    <a href="{{route('privacyandpolicy')}}" class="text-decoration-none">
			<div class="col-11 d-flex" id="items">
					<div class="col-1" id="item_Icon">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</div>
					<div class="col-4 ms-2" id="icon_heading">Privacy and Policy</div>
			</div>
	    </a>
	    <a href="{{route('contacUs')}}" class="text-decoration-none">
			<div class="col-11 d-flex" id="items">
					<div class="col-1" id="item_Icon">
						<i class="fa fa-address-card" aria-hidden="true"></i>
					</div>
					<div class="col-4 ms-2" id="icon_heading">Contact Us</div>
			</div>
	    </a>
			<div class="col-11 d-flex" id="items" onclick="myFunction()">
					<div class="col-1" id="item_Icon">
						<i class="fa fa-copyright" aria-hidden="true"></i>
					</div>
					<div class="col-4 ms-2" id="icon_heading">Copyrights</div>
			</div>
			<!------------------------------- Starts CopyRight Hide Container ------------------------------------>
	    <div class="col-8 " id="copyright_Container">
				<div class="col-8 mx-auto border-danger mt-3" >
				  <img src="{{asset('images/default.jpg')}}" width="100%" class="mt-4">
				</div>
				<div class="col-8 mx-auto mt-2" id="akhbaar_Heading">
				  MOBILE AKHBAAR
				</div>
				<div class="col-8 mx-auto mt-2" id="copyright_Content">
					<p class="text-center">Version 0.1.84</p>
					<p class="">Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2023 Idetion.</p>
					<p class="text-center">All rights reserved.</p>
				</div>
      </div>
      <!------------------------------- Ends CopyRight Hide Container ------------------------------------>
	@if(session()->has('currentUser_MobileApp'))
	  <a href="{{route('logoutMobile')}}" class="text-decoration-none">
			<div class="col-11 d-flex" id="items">
					<div class="col-1" id="item_Icon">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
					</div>
					<div class="col-4 ms-2" id="icon_heading">Logout</div>
			</div>
	  </a>
	@endif
	</div>
<script type="text/javascript">
	//copyRight Showing Container

  function myFunction() {
    var x = document.getElementById("copyright_Container");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
<!--  CDN for jQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Custom JavascripT for Mobile View -->
<script src="{{asset('Js_News_frontend_pages/mobileViewScript.js')}}"></script>
@extends('Layouts.mobileFooter')
</body>
</html>
		