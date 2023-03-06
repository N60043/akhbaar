<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bookmarks</title>
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/mobileViewStyles.css')}}">
</head>
<body>
		<div class="boookMarks_Container">
			<a class="text-decoration-none d-flex" href="{{url()->previous()}}">
				<h1 class="mt-2 ms-3" id="heading_Bookmarks">Bookmarks</h1>
				<div class="col-1 mt-3 ms-auto">
			        <i class="fa fa-arrow-left " aria-hidden="true"></i>
			    </div>
		    </a>
		 @foreach($getBookmarkdata as $data)
		 @php
			$imgBookmark = json_decode($data->img);
		 @endphp
	      @if(session()->has('currentUser_MobileApp'))
          <a class="text-decoration-none text-white" href="{{route('categoryDetail',$data->news_id)}}">
        @else
          <a class="text-decoration-none text-white" href="{{url('signIn')}}/{{$data->news_id}}">
        @endif
			  <div class="mt-3 position-relative" id="bookmarks_FrontImagConatainer">
			  	<p class="ms-4" id="bookmarksData_date">{{$data->date}}</p>

           @if($data->img==null)
			  <img src="{{asset('images/default.jpg')}}" width="100%" height="34%">
		   @else
			  <img src="{{$imgBookmark[0]->img ?? asset('images/default.jpg')}}" width="100%" height="34%">
		   @endif
			  	<p class="mt-2" id="bookmarksData_title">{{$data->title}}</p>
			  	<p id="bookmarksData_description">
			  		{{$data->description}}
			  	</p>
			  	<span class="d-flex" id="bookmarksData_Read">Read <i class="fa fa-arrow-right mt-1 ms-1" aria-hidden="true"></i></span>
			  </div>
			</a>
		  @endforeach
		</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
<!--  CDN for jQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Custom JavascripT for Mobile View -->
<script src="{{asset('Js_News_frontend_pages/mobileViewScript.js')}}"></script>
@extends('Layouts.mobileFooter')
</body>
</html>