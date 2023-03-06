@include('Layouts.mobileHeader')
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
</head>
<body>

@if(Route::is('getBookmark'))
<div class="mt-1 ms-3" id="UpdatehomeContainer">
@else
<div class="mt-1 ms-3" id="homeContainer">
@endif
 @if (Session::has('error'))
	<div class="col-12 mx-auto mt-4 alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert">
				<i class="fa fa-times"></i>
			</button>
			<strong style="font-size:12px">Error !  {{ session('error') }}</strong>
	</div>
@endif
	@foreach($newsHome as $data)
		@php
		$imgMobile = json_decode($data->img_features);
		@endphp
	 @if($loop->iteration==1 || $loop->iteration==4 || $loop->iteration==7 || $loop->iteration==10 || $loop->iteration==13 || $loop->iteration==16 || $loop->iteration==19)
		<div class="col-12 mt-2" id="mobileHome_firstBlog">
			@if(session()->has('currentUser_MobileApp'))
	      <a class="text-decoration-none text-white" href="{{route('categoryDetail',$data->news_id)}}" onclick="window.speechSynthesis.cancel();">
	    @else
	      <a class="text-decoration-none text-white" href="{{url('signIn')}}/{{$data->news_id}}" onclick="window.speechSynthesis.cancel();">
	    @endif
			<div class="col-12">
				 @if($data->img_features==null)
				<img src="{{asset('images/default.jpg')}}" width="100%" id="Home_firstBlogImage">
				@else
				<img src="{{$imgMobile[0]->img ?? asset('images/default.jpg')}}" width="100%" id="Home_firstBlogImage">
				@endif
			</div>
			<div class="col-12 mt-3" id="Home_firstBlogTitle">
				@if($data->newspaper_id==3 || $data->newspaper_id==10 || $data->newspaper_id==11)
				<p id="firstBlogTitle_Urdu">{{$data->title}}</p>
				@else
				<p id="firstBlogTitle">{{$data->title}}</p>
				@endif
				 
			</div>
			<div class="col-11 ms-3" id="Home_firstBlogDescription">
				@if($data->newspaper_id==3 || $data->newspaper_id==10 || $data->newspaper_id==11)
				<p class="firstBlogDescription_Urdu">{!! strip_tags($data->description) !!}</p>
				@else
				<p class="firstBlogDescription">{!! strip_tags($data->description) !!}</p>
				@endif
			</div>
		</a>
			<div class="col-12 d-flex" id="Home_firstBloglastDiv">
				<p>{{$data->date}} <span class="ms-1">{{Str::upper($data->getNewspaper->pluck('name')->implode(','))}}</span></p>
				<div class="c0l-6 d-flex ms-auto" id="playSoundBookmark-Container">
						@if($data->newspaper_id==3 || $data->newspaper_id==10 || $data->newspaper_id==11)
						<a  href="#" id="HomeplaySoundContainer" onclick="firstBlogstitleSound_Urdu('{{$data->title}}')">
						@else
						<a  href="#" id="HomeplaySoundContainer" onclick="firstBlogstitleSound_English('{{$data->title}}')">
						@endif
			          <i class="fa fa-volume-up" aria-hidden="true"></i> 
			      </a>
			      <a href="{{route('insertBookmark',$data->news_id)}}" class="ms-2 " id="bookmark_Container" onclick="window.speechSynthesis.cancel();">
			      	@if($data->getBookmark==null)
			      	<i class="fa fa-bookmark" aria-hidden="true"></i>
			      	@else
			      	<i class="fa fa-bookmark {{($data->news_id==$data->getBookmark->news_id) ? 'bookmarkActive':'' }}" aria-hidden="true"></i>
			      	@endif
			         
			      </a>
				</div>
			</div>
		</div>
	  @endif
	  @if($loop->iteration==2 || $loop->iteration==5 || $loop->iteration==8 || $loop->iteration==11 || $loop->iteration==14 || $loop->iteration==17 || $loop->iteration==20)
		<div class="col-12 d-flex flex-wrap mt-3 " id="Home_SecondBlog">
			    @if(session()->has('currentUser_MobileApp'))
					  <a class="text-decoration-none text-white d-flex" href="{{route('categoryDetail',$data->news_id)}}" onclick="window.speechSynthesis.cancel();">
			    @else
			      <a class="text-decoration-none text-white d-flex" href="{{url('signIn')}}/{{$data->news_id}}" onclick="window.speechSynthesis.cancel();">
			    @endif
	        <div class="col-8" id="title">
	        	@if($data->newspaper_id==3 || $data->newspaper_id==10 || $data->newspaper_id==11)
	        	<span class="col-11 ms-1" id="secondBlogtitle_Urdu">{{$data->title}}</span>
	        	@else
	        	<span class="col-11" id="secondBlogtitle">{{$data->title}}</span>
	        	@endif
	        </div>
	        <div class="col-4 ms-auto" id="Image">
			      @if($data->img_features==null)
						<img src="{{asset('images/default.jpg')}}" width="100%">
						@else
						<img src="{{$imgMobile[0]->img ?? asset('images/default.jpg')}}" width="100%" >
						@endif
	        </div>
	      </a>
	        <p class="mt-2">{{$data->date}} <span class="ms-1">{{Str::upper($data->getNewspaper->pluck('name')->implode(','))}}</span></p>
			<div class="c0l-3 d-flex ms-auto mt-2" id="playSoundBookmark-Container">
				@if($data->newspaper_id==3 || $data->newspaper_id==10 || $data->newspaper_id==11)
				<a  href="#" id="HomeplaySoundContainer" onclick="firstBlogstitleSound_Urdu('{{$data->title}}')">
				@else
				<a  href="#" id="HomeplaySoundContainer" onclick="firstBlogstitleSound_English('{{$data->title}}')">
				@endif
		          <i class="fa fa-volume-up " aria-hidden="true"></i> 
		      </a>
		        <a  href="{{route('insertBookmark',$data->news_id)}}"  class="ms-2" id="bookmark_Container" onclick="window.speechSynthesis.cancel();">
		        	@if($data->getBookmark==null)
			      	<i class="fa fa-bookmark" aria-hidden="true"></i>
			      	@else
			      	<i class="fa fa-bookmark {{($data->news_id==$data->getBookmark->news_id) ? 'bookmarkActive':'' }}" aria-hidden="true"></i>
			      	@endif
			    </a>
			</div>
	   </div>
	   @endif
	    @if($loop->iteration==3 || $loop->iteration==6 || $loop->iteration==9 || $loop->iteration==12 || $loop->iteration==15 || $loop->iteration==18 || $loop->iteration==21)
	   <div class="col-12 d-flex flex-wrap mt-3 " id="Home_SecondBlog">
	   	    @if(session()->has('currentUser_MobileApp'))
					  <a class="text-decoration-none d-flex text-white" href="{{route('categoryDetail',$data->news_id)}}" onclick="window.speechSynthesis.cancel();">
			    @else
			      <a class="text-decoration-none d-flex text-white" href="{{url('signIn')}}/{{$data->news_id}}" onclick="window.speechSynthesis.cancel();">
			    @endif
	        <div class="col-8" id="title">
	        	@if($data->newspaper_id==3 || $data->newspaper_id==10 || $data->newspaper_id==11)
	        	<span class="col-11 ms-1" id="thirdBlogtitle_Urdu">{{$data->title}}</span>
	        	@else
	        	<span class="col-11" id="thirdBlogtitle">{{$data->title}}</span>
	        	@endif
	        </div>
	        <div class="col-4 ms-auto" id="Image">
			      @if($data->img_features==null)
						<img src="{{asset('images/default.jpg')}}" width="100%">
						@else
						<img src="{{$imgMobile[0]->img ?? asset('images/default.jpg')}}" width="100%" >
						@endif
	        </div>
	      </a>
	        <p class="mt-2">{{$data->date}} <span class="ms-1">{{Str::upper($data->getNewspaper->pluck('name')->implode(','))}}</span></p>
			<div class="c0l-3 d-flex ms-auto mt-2" id="playSoundBookmark-Container">
						@if($data->newspaper_id==3 || $data->newspaper_id==10 || $data->newspaper_id==11)
						<a  href="#" id="HomeplaySoundContainer" onclick="firstBlogstitleSound_Urdu('{{$data->title}}')">
						@else
						<a  href="#" id="HomeplaySoundContainer" onclick="firstBlogstitleSound_English('{{$data->title}}')">
						@endif
		          <i class="fa fa-volume-up " aria-hidden="true"></i> 
		        </a>
		      <a  href="{{route('insertBookmark',$data->news_id)}}"  class="ms-2 " id="bookmark_Container" onclick="window.speechSynthesis.cancel();">
		       	@if($data->getBookmark==null)
			      	<i class="fa fa-bookmark" aria-hidden="true"></i>
			      	@else
			      	<i class="fa fa-bookmark {{($data->news_id==$data->getBookmark->news_id) ? 'bookmarkActive':'' }}" aria-hidden="true"></i>
			      	@endif
		      </a>
			</div>
	   </div>
	   @endif
	@endforeach
</div>
 
<script type="text/javascript">
	// home Sound Active
	$('#HomeplaySoundContainer i').on('click', function () {
	$('#HomeplaySoundContainer i').removeClass('soundActive');// here remove class selected from all showfood
	$(this).addClass('soundActive');// here apply selected class on clickable showfood

	});
	</script>
	<script type="text/javascript">
	function firstBlogstitleSound_English(title)
{
  window.speechSynthesis.cancel();
  const titleEnglish=new SpeechSynthesisUtterance(title);
  titleEnglish.lang = 'en';
  window.speechSynthesis.speak(titleEnglish);
}
function firstBlogstitleSound_Urdu(title)
{
  window.speechSynthesis.cancel();
  const titleUrdu=new SpeechSynthesisUtterance(title);
  titleUrdu.lang = 'ur-PAK';
  window.speechSynthesis.speak(titleUrdu);
  console.log(titleUrdu);
}
function getBookmarkActive(news_id)
  {
var id = news_id;
var url = '{{ route("insertBookmark", ":id") }}';
var Success = false;
//Call ajax
$.ajax({
    type : "get",
    url : url,
    success:function(response){
          response = true;
    }
});
 
  }

	</script>
@extends('Layouts.mobileFooter')
</body>
</html>




 