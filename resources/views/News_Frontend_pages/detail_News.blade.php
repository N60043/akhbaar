<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Detail News</title>
</head>
<body style="background-color: black;" id="mainContainer_detailNews">
  @include('Layouts.header')
<div class="col-lg-12" >
  <div class="row col-sm-12  mt-4 d-flex d-table-cell" id="topRead_container">
    <div class="col-sm-8 col-md-8 col-xl-8" id="topRead_subContainer" >
    	<strong class="topRead">TODAY'S TOP READ</strong>
      <marquee class="ml-3 position-absolute" direction="left"  behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="width: 95%;">
       @foreach($today_TopRead as $data)
        <a class="ml-4" href="{{$url}}/{{$data->news_id}}" style="text-decoration: none;color:white;">
          {{$data->title}}
	     <i class="fas fa-caret-right position-absolute" id="topRead_marquee" ></i>
       </a>
        @endforeach
	   </marquee>
    </div>
  </div>
  <div class="row col-lg-12 col-md-12 col-sm-12 mt-5 d-flex" id="main_newsContainer" >
    @php 
      $imgdata = json_decode($getDetailNews_Info->img_features);
    @endphp
  	<div class="col-md-12 col-sm-12">
       @if(session()->has('Urdu'))
       <button class="btn btn-danger" style="borrder-radius:6px">{{Str::upper($getDetailNews_Info->getNewsCategory->pluck('urdu_name')->implode(','))}}</button>
       @else
       <button class="btn btn-danger" style="borrder-radius:6px">{{Str::upper($getDetailNews_Info->getNewsCategory->pluck('name')->implode(','))}}</button>
       @endif
      @if(session()->has('Urdu'))
  	  	<h4 class="mt-3 text-right" id="heading_newsContainer" style="direction: rtl;">{{$getDetailNews_Info->title}}</h4>
  	  	<span>{{date('l, d-m-Y', strtotime($getDetailNews_Info->date))}}</span>
      @else
        <h4 class="mt-3" id="heading_newsContainer" >{{$getDetailNews_Info->title}}</h4>
        <span>{{date('l, d-m-Y', strtotime($getDetailNews_Info->date))}}</span>
      @endif
  	</div>
  	<div class="col-xl-7 col-md-6 col-sm-12 mt-3" >
  		<button id="newsContainerbutton">{{Str::upper($getDetailNews_Info->getNewspaper->pluck('name')->implode(','))}}</button>
            @if($getDetailNews_Info->img_features==null)
              <img class="mt-3" src="{{asset('images/default.jpg')}}" id="main_image"  width="100%" height="">
            @else
            <img class="mt-3" src="{{$imgdata[0]->img ?? asset('images/default.jpg')}}" id="main_image"  width="100%" height="">
           @endif
  	</div>
        
  	<div class="scrollmenu_recentNews col-xl-4 col-md-5" id="recentNews_container">
  	  	<h4 class="trending_news_heading" >RECENT NEWS</h4>
  	  	<?php $i = 1; ?>
        @foreach($recentNews as $data)
        <div class="row " style="border:none" >
        <div class="col-md-2 col-lg-2 ml-4" style="">
          @if(session()->has('Urdu'))
          <span id="count_recentNewsUrdu">0<?= $i; ?></span>
          @else
          <span id="count_recentNews">0<?= $i; ?></span>
          @endif
	  	  </div>
      
	  	 <div id="Recent_headingParagraph_container" >
        <a href="{{$url}}/{{$data->news_id}}" style="text-decoration: none;color:white;">
          @if(session()->has('Urdu'))
          <h5 class="float-right RecentUrdu_Heading" id="sub_HeadingUrdu" style="text-align: right;" maxlength="20" >{{Str::upper($data->title)}}</h5>
          <p class="text-right" id="paragraph_recentNews" style="direction: rtl;margin-left:-0.7rem">{!! strip_tags($data->description) !!}</p>
          <div class="dropdown-divider" id="divider_recentNews" style="width: 112%;"></div>
          @else
          <h5 id="sub_Heading" maxlength="20">{{Str::upper($data->title)}}</h5>
          <p id="paragraph_recentNews">{!! strip_tags($data->description) !!}</p>
          <div class="dropdown-divider" id="divider_recentNews"></div>
          @endif
        </a>
	  	 </div>
  	  	<?php $i++; ?>
  	  	</div>
  	  	@endforeach
  	</div>
    <div class="col-md-12 col-sm-11 d-flex mt-4">
    	<h6 style="color:#D02B2B">BY:</h6>
    	<hr class="mt-4" id="fullDescription" style="">
  	</div>
    @if(session()->has('Urdu'))
  	<div class="col-md-7 d-flex mt-3 text-right text-justify" style="direction: rtl;">
      {!! strip_tags($getDetailNews_Info->description) !!}
      </br>
      @if($getDetailNews_Info->summary=='null')
      <div></div>
      @else
      {!! strip_tags($getDetailNews_Info->summary) !!}
      @endif
  	</div>
    @else
    <div class="col-md-7 col-sm-11 d-flex mt-3 text-justify">
      {!! strip_tags($getDetailNews_Info->description) !!}
    </div>
    @endif
  	<div class="dropdown-divider ml-3 mt-4" id="devider_fullDescription"></div>

  </div>
  <div class="row mt-5" id="relatedNews_Container">
    <div class="col-md-10 col-sm-9 d-flex" style="margin: auto;color: white;">
        <h4 id="heading_relatedNews" >Releated News</h4>
    </div>
  </div>
  <div class="row d-flex col-xl-12" id="releatedNews_container"  >
    <div class="col-md-8 col-sm-6" style="display: contents;">
     @foreach($showRelatedNews as $data)
     @php
        $imgdata = json_decode($data->img_features);
      @endphp
     @if($loop->first)
     <a href="{{$url}}/{{$data->news_id}}" id="related_News_Anchortag" style="text-decoration: none;">
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mt-2" id="top-left" >
        @if($data->img_features==null)
        <img src="{{asset('images/default.jpg')}}" alt="{{$data->title}}" width="100%" style="height: 67%;">
        @else
        <img src="{{$imgdata[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}" width="100%" style="height: 67%;">
        @endif
        @if(session()->has('Urdu'))
           <button class="btn btn-danger mt-3" id="news_buttons">{{Str::upper($getDetailNews_Info->getNewspaper->pluck('name')->implode(','))}}</button>
           <h4 class="mt-1 text-right" id="relatedNewsBlogs_Heading" style="direction: rtl;word-break: break-all;overflow: hidden;text-overflow: ellipsis;
    display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">{!! strip_tags($data->description) !!}{!! strip_tags($data->description) !!}</h4>
           <p class="text-white" style="margin-top: 0px ;margin-bottom: 0px;">{{date('l, d-m-Y', strtotime($data->date))}}</p>
           <a class="topStories_readMore float-left mt-2 d-none" href="" >Read More ></a>
        @else
           <button class="btn btn-danger mt-3" id="news_buttons">{{Str::upper($getDetailNews_Info->getNewspaper->pluck('name')->implode(','))}}</button>
           <h4 class="mt-1" id="relatedNewsBlogs_Heading" style="ord-break: break-all;overflow: hidden;text-overflow: ellipsis;
    display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">{!! strip_tags($data->description) !!}</h4>
           <p class="text-white" style="margin-top: 0px ;margin-bottom: 0px;">{{date('l, d-m-Y', strtotime($data->date))}}</p>
           <a class="topStories_readMore float-left mt-2 d-none" href="" >Read More ></a>
        @endif
      </div>
      </a>
      @endif
      @if($loop->iteration>1 )
        <a href="{{$url}}/{{$data->news_id}}" id="related_News_Anchortag" style="text-decoration: none;">
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mt-2" id="top-left" style="margin-left: -0.3em;">
          @if($data->img_features==null)
          <img src="{{asset('images/default.jpg')}}" alt="{{$data->title}}" width="100%" style="height: 67%;">
          @else
          <img src="{{$imgdata[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}" width="100%" style="height: 67%;">
          @endif
          @if(session()->has('Urdu'))
            <button class="btn btn-danger mt-3" id="news_buttons">{{Str::upper($data->getNewspaper->pluck('name')->implode(','))}}</button>
            <h4 class="mt-1 text-right " id="relatedNewsBlogs_Heading" style="direction: rtl;ord-break: break-all;overflow: hidden;text-overflow: ellipsis;
              display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">{!! strip_tags($data->description) !!}</h4>
            <p class="text-white" style="margin-top: 0px ;margin-bottom: 0px;">{{date('l, d-m-Y', strtotime($data->date))}}</p>
            <a class="topStories_readMore float-left mt-2 d-none" href="#" >Read More ></a>
          @else
            <button class="btn btn-danger mt-3" id="news_buttons">{{Str::upper($data->getNewspaper->pluck('name')->implode(','))}}</button>
            <h4 class="mt-1 " id="relatedNewsBlogs_Heading" style="ord-break: break-all;overflow: hidden;text-overflow: ellipsis;
              display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">{!! strip_tags($data->description) !!}</h4>
            <p class="text-white" style="margin-top: 0px ;margin-bottom: 0px;">{{date('l, d-m-Y', strtotime($data->date))}}</p>
            <a class="topStories_readMore float-left mt-2 d-none" href="#" >Read More ></a>
          @endif
        </div>
        </a>
      @endif
     @endforeach
    </div>
  </div>

<!-- First Container Div --> 
 {{----------------------------- more and Less Button ------------------------------------------------}}
      {{-- <button type="button " class="btn btn-danger btn-floating btn_more" id="more">
        <i class="fas fa-arrow-down"></i>
      </button>
      <button type="button " class="btn btn-danger btn-floating btn_less" id="less">
        <i class="fas fa-arrow-up"></i>
      </button>

       <section class="national" id="moreNews">
        <div class="d-flex flex-wrap" >
           @foreach($showRelatedNews as $data)
              @if($loop->iteration>4)
                @php
                      $imgnational = json_decode($data->img_features);
                @endphp
                  @if(session()->has('currentUser_MobileAkhbaar'))
                    <a  href="{{route('detailNewsWeb',$data->news_id)}}" >
                      @else
                        <a href="{{url('userLogin/')}}/{{$data->news_id}}">
                  @endif
                      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cols mt-4">
                        @if($data->img_features==null)
                          <img class="nations-image" 
                            src="{{asset('images/default.jpg')}}" alt="{{$data->title}}"
                              style="width: 100%; border-radius: 7px;height: 11rem;"
                            />
                        @else
                          <img class="nations-image" 
                              src="{{$imgnational[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                              style="width: 100%; border-radius: 7px;height: 11rem !important;"
                            />
                        @endif
                        <button class="news-btn btn btn-danger">{{Str::upper($data->getNewspaper->pluck('name')->implode(','))}}</button>
                        <h3 class="news-title text-white mt-1">{!! strip_tags($data->title) !!}</h3>
                        <span class="date text-white">{{$data->date}}</span><br>
                        <a class="more-link" href="#">Read More ></a>    
                      </div>
                    </a>
              @endif
            @endforeach
          </div>
      </section> --}} 
</div>
@include('Layouts.footer')

</body>
</html>