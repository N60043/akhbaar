<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail News</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/mobileViewStyles.css')}}">
</head>
<body>
@if(session()->has('NewspaperNameById'))  
<a href="{{route('akhbaarNews',$getDetailNews_Info->newspaper_id)}}">  <div class="col-12 d-flex" id="akhbaarActive">
   <span class="float-right mx-auto">{{session()->get('NewspaperNameById')}}</span>
  </div>
</a>
@endif
<div class="mt-1 ms-2" id="categoryDetail_Container">
    <div class="col-12 d-flex mt-2" id="categoryDetail_HeaderContainer">
      @if(session()->has('akhbaarNews'))
        <a class="text-decoration-none " href="{{url()->previous()}}" onclick="window.speechSynthesis.cancel();">
      @else
         <a class="text-decoration-none " href="{{route('Home-MobileAkhbaar')}}" onclick="window.speechSynthesis.cancel();">
      @endif
        <div class="col-1 mt-1 ms-2">
          <i class="fa fa-arrow-left " aria-hidden="true"></i>
        </div>
      </a>
      <div class="col-11 ms-2">
      <marquee class="ms-1" direction="left" direction="left" scrollamount="4" onmouseover="this.stop();" onmouseout="this.start();">
        @foreach($latestNews as $data)
        <a href="{{$url}}/{{$data->news_id}}">
           @if($getDetailNews_Info->newspaper_id==3 OR $getDetailNews_Info->newspaper_id==10 OR $getDetailNews_Info->newspaper_id==11)
           <span id="marqueetitle_Urdu">{{$data->title}}</span>
           @else
           <span id="marquee_title">{{$data->title}}</span>
           @endif
          <i class="fas fa-caret-right px-2"></i>
        </a>
        @endforeach
      </marquee>       
      </div>
    </div>
  @php 
      $imgCategoryNews = json_decode($getDetailNews_Info->img_features);
  @endphp
    <div class="mt-3 ms-2" id="cetegory_image">
     @if($imgCategoryNews==null)
      <img src="{{asset('images/default.jpg')}}" width="100%">
     @else
      <img src="{{$imgCategoryNews[0]->img ?? asset('images/default.jpg')}}" width="100%" >
     @endif
    </div>
    <div class="col-12 mt-2 ms-1 d-flex" id="playSound_Bookmarks_Container">
         @if($getDetailNews_Info->newspaper_id==3 || $getDetailNews_Info->newspaper_id==10 || $getDetailNews_Info->newspaper_id==11)
      <a class="col-5 d-flex" href="#" id="categoryDetail_playSoundContainer" onclick="playSoundBorderRed();firstBlogstitleSound_Urdu('{{$getDetailNews_Info->title}}')">
      @else
      <a class="col-5 d-flex" href="#" id="categoryDetail_playSoundContainer" onclick="playSoundBorderRed();firstBlogstitleSound_English('{{$getDetailNews_Info->title}}')">
      @endif
          <i class="fa fa-volume-up mt-1" aria-hidden="true"></i> 
          <span class="ms-2">Play Sound</span>
        </a>
        @if($getDetailNews_Info->getBookmark==null)
         <a href="{{route('insertBookmark',$getDetailNews_Info->news_id)}}"  class="col-3 ms-auto " id="categoryDetail_bookmarks" onclick="window.speechSynthesis.cancel();">
        @else
        <a href="{{route('insertBookmark',$getDetailNews_Info->news_id)}}"  class="col-4  {{($getDetailNews_Info->news_id==$getDetailNews_Info->getBookmark->news_id) ? 'CategorybookmarkActive':'' }}" id="categoryDetail_bookmarks" onclick="window.speechSynthesis.cancel();">
        @endif
            <i class="fa fa-bookmark" aria-hidden="true"></i>
            <span >Bookmarks</span>
        </a>
    </div>
    <div class="col-9 mt-3 ms-2" id="categoryDetail_date">
        <p>{{$getDetailNews_Info->date}}</p>
    </div>
    <div class="col-8 mt-3 d-flex ms-2" id="categoryDetail_publish">
        <p>Publisher:</p>
        <span class="ms-2" id="news_name">{{Str::upper($getDetailNews_Info->getNewspaper->pluck('name')->implode(','))}}</span>
    </div>
   <div class="col-12 mt-2 ms-2" id="categoryDetail_ContentContainer">
      <div class="col-12" id="category_title">
        @if($getDetailNews_Info->newspaper_id==3 OR $getDetailNews_Info->newspaper_id==10 OR $getDetailNews_Info->newspaper_id==11)
        <p id="detailNewsTitle_Urdu">{{$getDetailNews_Info->title}}</p>
        @else
        <p id="detailNews_Title">{{$getDetailNews_Info->title}}</p>
        @endif
      </div>
       <div class="mt-3 " id="category_description">
         @if($getDetailNews_Info->newspaper_id==3 OR $getDetailNews_Info->newspaper_id==10 OR $getDetailNews_Info->newspaper_id==11)
          <p id="detailNewsDescription_Urdu">{{$getDetailNews_Info->description}}</p>
         @else
          <p id="detailNews_Description">{{$getDetailNews_Info->description}}</p>
         @endif
      </div>

      <!-- Share Container Display none -->
      <div id="shareContainer" class="mt-3 d-flex d-none">
        <span id="shareHeading">Share</span>
        <div class="col-4 ms-auto d-flex" id="shareIcone_Container">
          <a class="btn btn-lg btn-floating rounded-circle ms-auto" id="shareIcon" href="#!" role="button">
             <i class="fab fa-facebook"></i>
          </a>
          <a class="btn btn-lg btn-floating ms-2 rounded-circle" id="shareIcon" href="#!" role="button">
             <i class="fab fa-twitter"></i>
          </a>
        </div>
      </div>
    </div>
  
    <div class="col-10 mt-4" id="relatedNews_Container">
      <h6 class="ps-2 ms-2 col-5" id="relatedNews_Heading" >Related News</h6>
       @foreach($showRelatedNews as $data)
       @php
        $imgRelatedNews = json_decode($data->img_features);
       @endphp
       <a href="{{$url}}/{{$data->news_id}}" onclick="window.speechSynthesis.cancel();">
        <div class="d-flex mt-2 ms-2" id="relatedNews_ContentContainer">
          <div class="col-8">
             <p id="relatedNews_date">{{$data->api_Date}}</p>
             @if($data->newspaper_id==3 || $data->newspaper_id==10 || $data->newspaper_id==11)
             <span class="col-12" id="relatedNewstitle_Urdu">{{$data->title}}</span>
             @else
              <span class="col-12" id="relatedNews_title">{{$data->title}}</span>
             @endif
          </div>
          <div class="col-5 ms-auto" id="relatedNews_Image">
            @if($data->img_features==null)
              <img src="{{asset('images/default.jpg')}}" width="100%">
            @else
              <img src="{{$imgRelatedNews[0]->img ?? asset('images/default.jpg')}}" width="100%" >
            @endif
          </div>
        </div>
       </a>
       @endforeach
    </div>
  </div>

<script type="text/javascript">
  function firstBlogstitleSound_English(title)
{
  window.speechSynthesis.cancel();
  const titleEnglish=new SpeechSynthesisUtterance(title);
  window.speechSynthesis.speak(titleEnglish);
}
function firstBlogstitleSound_Urdu(title)
{
  window.speechSynthesis.cancel();
  const titleUrdu=new SpeechSynthesisUtterance(title);
  titleUrdu.lang = 'hi-IN';
  window.speechSynthesis.speak(titleUrdu);
}

function playSoundBorderRed()
  {
    const tem = document.getElementById('categoryDetail_playSoundContainer');
    if(tem)
    {
    tem.style.color="red";
    tem.style.border="2px solid red";
    tem.style.borderRadius="4px";
  }
  else
  {
    tem.style.color="white";
    tem.style.border="none";
    tem.style.borderRadius="4px";
  }
 }
//  
</script>
@extends('Layouts.mobileFooter')
</body>
</html>
  