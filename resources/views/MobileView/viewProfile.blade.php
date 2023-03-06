<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>
  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/mobileViewStyles.css')}}">
</head>
<body>
  <div id="viewProfile_Container">
    <a class="text-decoration-none d-flex" href="{{route('ViewSetting')}}">
       <h4 class="font-weight-bolder ms-3 mt-3" id="profile_heading">Profile</h4>
      <div class="col-1 mt-4 ms-auto">
        <i class="fa fa-arrow-left " aria-hidden="true"></i>
      </div>
    </a>
    <div class="col-12" id="profile_Container">
        <i class="fa fa-user-circle" aria-hidden="true"></i>
    </div>
    <div class="col-11 mx-auto d-flex flex-wrap mt-5">
      <div class="col-5 fw-bold " id="profileContent">Phone</div>
      <div class="col-7 text-end " id="profileContent">{{session()->get('loginUser_phone')}}</div>
      <div class="col-5 fw-bold mt-2" id="profileContent">Subscription Plan</div>
      <div class="col-7 text-end  mt-2" id="profileContent">
        @if(session()->get('loginUser_trial')==1)
        Trial
        @else
        Weekly
        @endif
      </div>
      <div class="col-5 fw-bold mt-2" id="profileContent">Til Valid</div>
      <div class="col-7 text-end mt-2" id="profileContent">{{session()->get('loginUser_ValidDate')}}</div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
<!--  CDN for jQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Custom JavascripT for Mobile View -->
<script src="{{asset('Js_News_frontend_pages/mobileViewScript.js')}}"></script>
 
@extends('Layouts.mobileFooter')
</body>
</html>