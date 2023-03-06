<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Us</title>
  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/mobileViewStyles.css')}}">
</head>
<body>
   <div class="col-12 d-flex mt-2 text-center pb-2" id="contactUs_Header">
    <a class="text-decoration-none " href="{{route('ViewSetting')}}">
      <div class="col-1 mt-1 ms-3">
        <i class="fa fa-arrow-left " aria-hidden="true"></i>
      </div>
    </a>
    <div class="col-10">
     <strong >Contact Us</strong>
   </div>
 </div>
  <div class="mt-4" id="contactUs_Content">
    <h3 class="font-weight-bolder mt-1" id="heading_ContactUs">CONTACT US</h3>
    <div class="col-11 mt-3">
      Any comments or suggestion,We'd love to hear from you.you can contact us on +92 341 1345821 or you can email us al akhbaar@ideationtec.com or you can drop your message to us.
    </div>
    <div class="col-11 mt-3">
     <h5>Insert Any Query on clicking Message Button</h5>
       <div class="mt-4" style="text-align: center;">
          <a href="mailto:akhbaar@ideationtec.com" style="color:white;font-size:5rem;" target="_blank">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </a>
        </div>
      {{-- <form class="contact_form">
      <div class="mb-3">
        <label for="name" class="form-label" id="conatct_label">YOUR NAME</label>
        <input type="text" class="form-control" id="contact_inputFields" name="name" placeholder="your name..">
      </div>
      <div class="mb-3 ">
        <label for="phone" class="form-label" id="conatct_label">YOUR PHONE</label>
        <input type="number" class="form-control" id="contact_inputFields" maxlength="11" name="phone" placeholder="your phone..">
      </div>
      <div class="mb-3">
        <label class="form-check-label" for="email" id="conatct_label">YOUR EMAIL</label>
        <input type="email" class="form-control" id="contact_inputFields" name="email" placeholder="your email..">
      </div>
       <div class="mb-3">
         <label class="form-check-label" for="query" id="conatct_label">YOUR QUERY</label>
        <input type="text" class="form-control" id="contact_inputFields" name="query" placeholder="your query..">
      </div>
      <div class="col-4 mx-auto">
        <button type="submit" class="btn btn-danger">Submit</button>
      </div>
      </form>
      </div> --}}
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
<!--  CDN for jQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Custom JavascripT for Mobile View -->
<script src="{{asset('Js_News_frontend_pages/mobileViewScript.js')}}"></script>
@extends('Layouts.mobileFooter')
</body>
</html>