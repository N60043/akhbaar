<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/mobileViewStyles.css')}}">
     <!-- Option 1: Bootstrap Bundle with Popper -->
    <title>@yield('title')</title>
  </head>
  <body>
  @if(session()->has('NewspaperNameById'))  
  <a href="{{route('akhbaarNews',$id)}}">  <div class="col-12 d-flex" id="akhbaarActive">
    <span class="float-right mx-auto">{{session()->get('NewspaperNameById')}}</span>
  </div>
</a>
  @endif
  <div class="scrollmenu" id="scrollmenu">
  <img class="ms-3" src="{{asset('images/logoAkhbaar.png')}}" style="width: 20%;">
     @foreach($headerCategories as $data)
       <a  class="{{Request::is('CategoryNews',$data->news_category_id)?'activeHeader':''}}" class="scrollAnchor" id="scrollLink" onclick="window.speechSynthesis.cancel();getCategoryNews('{{$data->news_category_id}}');">{{Str::upper($data->name)}}</a>
     @endforeach
  </div>
  <div class="categoryNews"></div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
   <!--  CDN for jQUERY -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Custom JavascripT for Mobile View -->
    <script src="{{asset('Js_News_frontend_pages/mobileViewScript.js')}}"></script> 
  <script>
  function getCategoryNews(categoryId)
  {
    var $ = jQuery;
  var id = categoryId;
var url = '{{route("CategoryNews", ":id") }}';
url = url.replace(':id', id);
//Call ajax
$.ajax({
    type : "get",
    url : url,
    dataType: 'html',
    success:function(response){
      $('#homeContainer').html(response);
    }
});
  }
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
  </div>
  </body>
</html>