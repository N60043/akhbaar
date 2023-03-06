<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/mobileViewStyles.css')}}">
     <!-- Option 1: Bootstrap Bundle with Popper -->
	<title>Newspaper</title>
</head>
<body>
<div class="newspaper_Container">
<div class="col-12 mt-1" id="headingNewspaper">
	<h6 class="pt-1">Newspapers</h6>
</div>
<div class="col-11 ms-3">
	<h3 class="fw-bold">We have got the best reads for you</h3>
	<p class="mt-3" id="selectNews">Select the newspaper you want to read</p>
</div>
<div class="col-12 ms-1 d-flex flex-wrap" style="border:1px soild white;">
@foreach($getNewspaper as $data)
	<div class="ms-2 mt-1 mb-4" id="akhbaarDiv">
	<a href="{{route('akhbaarNews',$data->id)}}">	
	    <img src="{{asset('uploads/')}}/{{$data->icon}}" id="akhbaarImage" width="100%" height="100%">
		 <p id="akhbaarName">{{$data->name}}</p>
	</a>
	</div>
@endforeach
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
