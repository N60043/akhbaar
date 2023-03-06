 @include('Layouts.header')
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
<body style="background: black !important;">
  <div id="viewProfile_Container">
    <h4 class="font-weight-bolder ms-3 mt-3 ps-3" id="profile_heading">Profile</h4>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-11 mx-auto d-flex flex-wrap mt-5" style="    border: 2px solid red;padding: 24px;">
      <div class="col-5 fw-bold " id="profileContent">Phone</div>
      <div class="col-7 text-end " id="profileContent">{{session()->get('loginUser_phone_Web')}}</div>
      <div class="col-5 fw-bold mt-2" id="profileContent">Subscription Plan</div>
      <div class="col-7 text-end  mt-2" id="profileContent">
        @if(session()->get('loginUser_trial_Web')==1)
        Trial
        @else
        Weekly
        @endif
      </div>
      <div class="col-5 fw-bold mt-2" id="profileContent">Til Valid</div>
      <div class="col-7 text-end mt-2" id="profileContent">{{session()->get('loginUser_ValidDate_Web')}}</div>
    </div>
  </div>
</body>
</html>
@include('Layouts.footer')