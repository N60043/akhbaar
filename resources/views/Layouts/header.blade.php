@php

use Illuminate\Support\Facades\DB;

@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>News</title>
  <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/styles.css')}}">   
   <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<style type="text/css">
.navbar a:hover
{
    color: white;
  background: transparent !important;
}
    .navbar .nav-link.active
{
    height: 3rem;
    color: #fff;
    background-color: #272B33 !important;
    margin-top: 3px;
    border-radius:5px;
}
</style>
</head>
<body class="header">
<div class="d-flex" style="background:#A5232B">
    <div class="logoAkhbaar">
     @if(session()->has('Urdu'))
      <a class="ml-2" href="{{route('homeUrdu')}}">
        <img src="{{asset('images/logoAkhbaar.png')}}"  style="width: 4rem;" >
      </a>
      @else
       <a class="ml-2" style="width: 7%;" 
                    href="{{route('homeEnglish')}}">
        <img src="{{asset('images/logoAkhbaar.png')}}" style="width: 4rem;" >
      </a>
      @endif
    </div>
    <div class="col-md-9" >
<nav id="navHome" class="navbar navbar-expand-lg navbar-light sticky-top">
  <div class="container-fluid max-width-940">
  
  <button class="navbar-toggler togglerNoBorder" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNavDropdown">
                 @foreach($header_Categories as $data)
                          @if(session()->has('English'))
                            @if($loop->iteration<=5)
                                <a class="nav-link " href="{{route('categoryDetailEnglish',$data->news_category_id)}}" >
                                    {{Str::upper($data->name)}}
                                </a>
                            @endif
                          @endif
                          @if(session()->has('Urdu'))
                            @if($loop->iteration<=8)
                                <a class="nav-link " href="{{route('categoryDetailUrdu',$data->news_category_id)}}">
                                    {{Str::upper($data->urdu_name)}}
                                </a>
                            @endif
                          @endif
                    @endforeach
                    <div class="dropdown ml-2">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: transparent;border: none;">
                        @if(session()->has('English'))
                                    <span id="moreEnglish">MORE</span>
                                  @else
                                    <span id="moreUrdu">مزید</span>
                                  @endif
                      </button>
                      <div class="dropdown-menu mt-1" aria-labelledby="dropdownMenu2">
                            @foreach($header_Categories as $data)
                                @if($loop->iteration>5)
                                   @if(session()->has('English'))
                                      <a class="dropdown-item mt-2" href="{{route('categoryDetailEnglish',$data->news_category_id)}}">
                                          {{Str::upper($data->name)}}
                                      </a>
                                    @else
                                      <a class="dropdown-item mt-2" href="{{route('categoryDetailUrdu',$data->news_category_id)}}">
                                        {{Str::upper($data->urdu_name)}}
                                      </a>
                                  @endif
                                  <div class="dropdown-divider"></div>
                                @endif
                            @endforeach 
                        {{-- <button class="dropdown-item" type="button">Action</button>
                        <button class="dropdown-item" type="button">Another action</button>
                        <button class="dropdown-item" type="button">Something else here</button> --}}
                      </div>
                    </div>
                     {{-- <div class="nav-link collapse navbar-collapse" id="navbar-list" onclick="myFunction()">
                                  <a class="navbar-brand dropdown-toggle ml-1" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                  @if(session()->has('English'))
                                    MORE
                                  @else
                                   fjdskfjh
                                  @endif
                                  </a>
                          <div class="border-0 " id="dropdown">
                            @foreach($header_Categories as $data)
                                @if($loop->iteration>5)
                                   @if(session()->has('English'))
                                      <a class="nav-link mt-2" href="{{route('categoryDetailEnglish',$data->news_category_id)}}">
                                          {{Str::upper($data->name)}}
                                      </a>
                                    @else
                                      <a class="nav-link mt-2" href="{{route('categoryDetailUrdu',$data->news_category_id)}}">
                                        {{Str::upper($data->urdu_name)}}
                                      </a>
                                  @endif
                                  <div class="dropdown-divider"></div>
                                @endif
                            @endforeach  --}}
      
</div>
</nav>
    </div>
      <div class="col-md-1 UrduuAkhbaar-Container" style="">
        <div class="UrduAkhbaar">
        @if(session()->has('English'))
         <a class="nav-link" id="UrduAkbaar-link" style="color:white" href="{{route('homeUrdu')}}">
                      اردو خبار 
         </a>
        @else
        <a class="nav-link" id="UrduAkbaar-link" style="width:7.4rem;color:white" href="{{route('homeEnglish')}}">
                      ENGLISH
         </a>
        @endif
        </div>
      </div>
        <div class="dropdown mt-1 " >
             <a class="navbar-brand" class="dropdown-toggle" data-toggle="dropdown" style="width:0px">
                      <i class="fa-solid fa-circle-user mt-1"style="font-size: 35px;color: white;"></i>
             </a>
            <div class="dropdown-menu " style="margin-left: -5.5rem !important;background: linear-gradient(#B4272F,#62141A);top: 1px !important;border: none;border-radius: 9px;">
             
      @if(session()->has('currentUser_MobileAkhbaar'))
              <a class="dropdown-item" href="{{route('ViewProfile_Web')}}" style="display:contents !important;font-size: 10px;font-weight: 600;color: white !important;" >
                {{-- <i class="fa fa-sign-out" aria-hidden="true"></i><span class="ml-1">PROFILE</span> --}}
                <span >PROFILE</span>
              </a>
               <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('subscriptionPlan')}}" style="display:contents !important;font-size: 10px;font-weight: 600;color: white !important;" >
                {{-- <i class="fa fa-sign-out" aria-hidden="true"></i><span class="ml-1">SUBSCRIPTION PLAN</span> --}}
                <span >SUBSCRIPTION PLAN</span>
              </a>
               <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('logout_MobileAkhbaar')}}" style="display:contents !important;font-size: 10px;font-weight: 600;color: white !important;" >
                {{-- <i class="fa fa-sign-out" aria-hidden="true"></i><span class="ml-1">LOGOUT</span> --}}
                <span >LOGOUT</span>
              </a>
               <div class="dropdown-divider"></div>
      @else
              <a class="dropdown-item" href="{{url("he")}}" style="display:contents !important;font-size: 10px;font-weight: 600;color: white !important;" >
                {{-- <i class="fa fa-sign-out" aria-hidden="true"></i><span class="ml-1">Login</span> --}}
                <span >LOGIN</span>
              </a>
     @endif
            </div>
        </div>
               
</div>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
    </script>
    <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
    </script>
    <script type="text/javascript">
        // header Item remain ctive after a Page reload
 const menuItem = document.querySelectorAll('#navHome a');
        menuItem.forEach(el => {
          // current
          if (el.getAttribute('href') === (window.location.href || 'detailNews/')) {
            el.classList.add("active")
          }

          // handle click
          el.addEventListener("click", e => {
            // remove others
            menuItem.forEach(el => el.classList.remove("active"))
            // set active
            e.target.classList.add("active")
          })
        })
    </script>
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyD_3SN-v068slIDl-2Nw8zKyl3ok_YSyFM",
    authDomain: "mobileakhbaarweb.firebaseapp.com",
    projectId: "mobileakhbaarweb",
    storageBucket: "mobileakhbaarweb.appspot.com",
    messagingSenderId: "445870616863",
    appId: "1:445870616863:web:c398cb5ecd57c2d1bc402a"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
</script>
<script>
{{-- function myFunction(){
      var more=document.getElementById("dropdown")
      $('#dropdown').toggle();
} --}}
</script>
</body>
</html>