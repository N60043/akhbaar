<!DOCTYPE html>
<html>
<head>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Home</title>
    <link rel="stylesheet" type="text/css" href="{{asset('Styles/styles.css')}}"> 
    <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- CDN for Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <!--  CDN for jQUERY -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style type="text/css">
  .navbar-toggler,
.navbar-toggler:focus,
.navbar-toggler:active,
.navbar-toggler-icon:focus {
    outline: none;
    box-shadow: none;
    border: 0;
    position: relative;
    margin-left: 50%;
}
a:hover 
{
color: black;
background-color: transparent;
text-decoration: underline;
text-decoration-color:black ;
}

</style>
   
   

</head>
<body>
    <div class="grand_parent">
      <div class="parents">
        <div class="child">
          <div  id="carouselExampleIndicators" class="carousel slide "  data-ride="carousel">
             <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
             </ol>
           <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="{{asset('images/10.jpg')}}" alt="First slide">
              <div class="carousel-caption   d-md-block md-auto " id="carousel_1">
               <button class="btn" id="btn_breakingNews">BREAKING NEWS</button>
              </div>
              <div class="carousel-caption  d-md-block md-auto " >
                <button class="btn " id="btn_geoNews">GEO NEWS</button>
              <h5 class="caption_1">Naqash sdkjasdhkasjdask dihasdjasldjasld asdajsd</h5>
              <p class="caption_2 font-weight-light">Abbasi djahkdjaskdhasdhjask askdhasdsjhakdasdk akdaldasd</p>
            </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="{{asset('images/11.jpg')}}" alt="Second slide">
              <div class="carousel-caption   d-md-block md-auto " id="carousel_1">
               <button class="btn" id="btn_breakingNews">BREAKING NEWS</button>
              </div>
              <div class="carousel-caption  d-md-block ">
                <button class="btn " id="btn_geoNews">GEO NEWS</button>
              <h5 class="caption_1">Zohaib dashdkjasdhjaskdaskd sadjasdnkasdjaad ajdakdsjasd</h5>
              <p class="caption_2 font-weight-light">Abbasi dhakjdhaskjdasd adnaskjdasd djadnad </p>
            </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="{{asset('images/12.jpg')}}" alt="Third slide">
              <div class="carousel-caption   d-md-block md-auto " id="carousel_1">
               <button class="btn" id="btn_breakingNews">BREAKING NEWS</button>
              </div>
              <div class="carousel-caption d-md-block ">
                <button class="btn" id="btn_geoNews">GEO NEWS</button>
              <h5 class="caption_1">Osama ajdhaskjdhaskdjas</h5>
              <p class="caption_2 font-weight-light">Abbasi jdhsakjdhsakdjashd</p>
            </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
         </div>
        </div>
        
        <div class="child scrollmenu" scrollmenu id="top-stories">
          <h4 class="top-stories_heading" >TOP STORIES</h4>
          <div class="col-md-12" id="top-stories_list" style="">
            <span >01</span>
            <h6> POLITICS</h6>
            <p class="font-weight-light" > Politics is the set of activities that are associated with making decisions in groups, or other forms of power relations among individuals, such as the</p>
            </div>
             <div class="dropdown-divider"></div>
          <div class="col-md-12" id="top-stories_list" style="">
            <span >02</span>
            <h6>SPORTS</h6>
            <p class="font-weight-light" >An activity involving physical exertion and skill in which an individual or team competes against another or others for entertainment.</p>
            </div>
            <div class="dropdown-divider"></div>
          <div class="col-md-12" id="top-stories_list" style="">
            <span >03</span>
            <h6>EDUCATION</h6>
            <p class="font-weight-light" >The process of receiving or giving systematic instruction, especially at a school or university.</p>
            </div>
             <div class="dropdown-divider"></div>
            <div class="col-md-12" id="top-stories_list" style="">
            <span >04</span>
            <h6>NATIONAL</h6>
            <p class="font-weight-light" >The process of receiving or giving systematic instruction, especially at a school or university.</p>
            </div>
             <div class="dropdown-divider"></div>
             <div class="col-md-12" id="top-stories_list" style="">
            <span >05</span>
            <h6>POLITICS</h6>
            <p class="font-weight-light" >The process of receiving or giving systematic instruction, especially at a school or university.</p>
            </div>
             <div class="dropdown-divider"></div>
             <div class="col-md-12" id="top-stories_list" style="">
            <span >06</span>
            <h6>SPORTS</h6>
            <p class="font-weight-light" >The process of receiving or giving systematic instruction, especially at a school or university.</p>
            </div>
             <div class="dropdown-divider"></div>
             <div class="col-md-12" id="top-stories_list" style="">
            <span >07</span>
            <h6>EDUCATION</h6>
            <p class="font-weight-light" >The process of receiving or giving systematic instruction, especially at a school or university.</p>
            </div>
             <div class="dropdown-divider"></div>
             <div class="col-md-12" id="top-stories_list" style="">
            <span >08</span>
            <h6>NATIONAL</h6>
            <p class="font-weight-light" >The process of receiving or giving systematic instruction, especially at a school or university.</p>
            </div>
             <div class="dropdown-divider"></div>
          </div>
      </div>

     <!----------------------------------------------------  Start Middle Bar Content ------------------------------------------------->

      <div class="middle-bar" >
          <a href="">
            <div class="middle-bar-items middle-bar-items-1" id="box-1">
              <img src="../images/image-gallery/geo_news.png" id="middle-bar-items-img">
              <span class="ml-3 w-50" id="middle-bar-items-mainHeading">GEO NEWS</span>
              <p  id="middle-bar-items-description">fdjdslfdskl dksjdlkasd adkjandaskd adkasjd skjfjhkf fjsfksdf fksjfsf skfjsf sf fkjsfksd fjskf <p>
            </div>
          </a>
         <a href="">
            <div class="middle-bar-items middle-bar-items-2" id="box-2">
              <img src="../images/image-gallery/aaj_news.png" id="middle-bar-items-img" style="float:left;">
              <span class="ml-3 w-50" id="middle-bar-items-mainHeading">AAJ NEWS</span>
              <p  id="middle-bar-items-description">fdjdslfdskl fdjdslfdskl dksjdlkasd adkjandaskd adkasjd skjfjhkf fjsfksdf fksjfsf skfjsf sf fkjsfksd fjskf</p>
            </div>
          </a>
          <a href="">
            <div class="middle-bar-items middle-bar-items-3" id="box-3">
              <img src="../images/image-gallery/express_news.png" id="middle-bar-items-img" style="float:left;">
              <span class="ml-3 w-50" id="middle-bar-items-mainHeading">EXPRESS NEWS</span>
              <p  id="middle-bar-items-description">fdjdslfdskl fdjdslfdskl dksjdlkasd adkjandaskd adkasjd skjfjhkf fjsfksdf fksjfsf skfjsf sf fkjsfksd fjskf</p>
            </div>
          </a>
          <a href="">
            <div class="middle-bar-items middle-bar-items-4" id="box-4">
              <img src="../images/image-gallery/pak_news.png" id="middle-bar-items-img" style="float:left;">
              <span class="ml-3 w-50" id="middle-bar-items-mainHeading">PAKISTAN NEWS</span>
              <p  id="middle-bar-items-description">fdjdslfdskl fdjdslfdskl dksjdlkasd adkjandaskd adkasjd skjfjhkf fjsfksdf fksjfsf skfjsf sf fkjsfksd fjskf</p>
            </div>
          </a>
      </div>

      <!----------------------------------------------------  Ends Middle Bar Content ------------------------------------------------>
     <div>
       ;sd;sl
     </div>
    </div>
  </body>
</html>
