<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>News Search</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/mobileViewStyles.css')}}">
    </head>
    <body>
         <h1 class="font-weight-bolder ms-2 mt-2" id="exploreHeading">Explore Topics</h1>
    <div class="search-Container ms-2 mt-4">
        <form action="#" id="search-form">
            <div class="p-1 bg-light mb-4 search-box">
              <div class="input-group">
                <input type="search" placeholder="Type a keyword here yor looking for..." aria-describedby="button-addon1" class="InputSearch">
                <div class="input-group-append">
                  <button id="button-addon1" type="submit" class="btn text-primary"><i class="fa fa-search" id="searchIcon"></i></button>
                </div>
              </div>
            </div>
             <div id="searchNews">

             </div>
          </form>
          <!-- End -->
    </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <!-- Custom JavascripT for Mobile View -->
    <script src="{{asset('Js_News_frontend_pages/mobileViewScript.js')}}"></script> 
    <script type="text/javascript">
        // Jquery Search Data;
        $(function ()
        {
            'use strict';
            $(document).on('keyup', '#search-form .InputSearch', function ()
            {
                if($(this).val().length > 0)
                {
                    var search = $(this).val();
                    $.get("{{ route('news.search') }}", {search: search}, function (res)
                    {
                        $('#searchNews').html(res);
                    });
                    return;
                }
                $('#searchNews').empty();
            });
           
        });
    </script>
@extends('Layouts.mobileFooter')
    </body>
</html>