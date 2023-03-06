 @include('Layouts.header')
 <!DOCTYPE html>
<html >
<head>
  <title>Home</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/styles.css')}}">  
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="Content_page" style="background: black;">
  <div class="grand_parent" >
      <div class="parents">
        <div class="child">
          <div  id="carouselExampleIndicators"  class="carousel slide " style=""  data-ride="carousel" data-interval="5000">
            <ol class="carousel-indicators">
                @foreach($showNewsSlider as $value)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
             </ol>
           <div class="carousel-inner" >
             @foreach($showNewsSlider as $data)
              @php
              $imgSlider = json_decode($data->img_features);
              @endphp
             <div class="carousel-item {{ $loop->first ? 'active' : '' }}" >
              @if(session()->has('currentUser_MobileAkhbaar'))
                  <a class="text-decoration-none text-white" href="{{route('detailNewsWeb',$data->news_id)}}">
                  @else
                  <a class="text-decoration-none text-white" href="{{url('userLogin/')}}/{{$data->news_id}}">
                  @endif
              @if($data->img_features==null)
                <img src="{{asset('images/default.jpg')}}" alt="{{$data->title}}" width="100%" height="622px">
              @else
                <img src="{{$imgSlider[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}" width="100%" height="622px">
              @endif
                <div class="carousel-caption   d-md-block md-auto " id="carousel_1">
               <button class="btn" id="btn_breakingNews">BREAKING NEWS</button>
              </div>
              <div class="carousel-caption  d-md-block md-auto " style="">
               
                <button class="btn " id="btn_News_carousal">{{$data->newspaper}}</button>
                  <h4 class="caption_1 mt-3">{{$data->title}}</h4>
                  <p class="caption_2 " style="font-size: 16px;">{!! strip_tags($data->description) !!}</p>
              </div>
              </a>
             </div>
            
          @endforeach 
          </div>
         </div>
        </div>
        
       <div class="child scrollmenu" style="" scrollmenu id="trending_news">
          <h4 class="trending_news_heading" >TRENDING NEWS</h4>
          <?php $i = 1; ?>
          @foreach($showTrendingNews as $data)
          <div class="col-md-12" id="trending_news_list" style="">
            <span >0<?= $i; ?></span>
             @if(session()->has('currentUser_MobileAkhbaar'))
                  <a class="text-decoration-none text-white" href="{{route('detailNewsWeb',$data->news_id)}}">
                  @else
                  <a class="text-decoration-none text-white" href="{{url('userLogin/')}}/{{$data->news_id}}">
                  @endif
              @if(session()->has('view_UrduAkhbaar'))
               <h3>{{Str::upper($data->urdu_category)}}</h4>
              @else
               <h3>{{Str::upper($data->category)}}</h4>
              @endif
              <p class="font-weight-light" style="font-size: 14px;"><strong >{{$data->title}}</strong>
            </a>
            </div>
           <hr id="hr_trendingNews"></hr>
             <?php $i++; ?>
            @endforeach

          </div>
          
      </div>

     <!----------------------------------------------------  Start Middle Bar Content ------------------------------------------------->

      <div class="middle-bar mt-2" >
        @foreach($newspaper as $data)
          <a class="text-decoration-none" href="{{route('EnglishAkhbaar',$data->id)}}">
            <img class="mt-2" src="{{asset('uploads/')}}/{{$data->icon}}" width="10%" title='{{$data->name}}'id="middle-bar-items-img">
            <div class="middle-bar-items middle-bar-items-1" id="box-1">
              <span class="ml-3 w-50" id="middle-bar-items-mainHeading">{{Str::upper($data->name)}}</span>
            </div>
          </a>
          @endforeach
      </div>
            <!----------------------------------------------------  Ends Middle Bar Content ------------------------------------------------>
      <!---------------------------------------------------- STARTS TOP-STORIES Content ------------------------------------------------>
   
  <div class="container-fluid bgclr-cls">
   @if($showTopStories->isEmpty())
       <div></div>
    @else
      <section class="top-stories">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-title">
              <h4 style="color: #fff;margin-left: 10px;">TOP STORIES</h4>
          </div>
        </div>  
        <div class="d-flex" style="margin-left: -1rem;">
          @foreach($showTopStories as $data)
            @php
            $imgTopStoiries = json_decode($data->img_features);
            @endphp
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
               @if(session()->has('currentUser_MobileAkhbaar'))
                  <a href="{{route('detailNewsWeb',$data->news_id)}}" class="d-flex">
                @else
                 <a href="{{url('userLogin/')}}/{{$data->news_id}}" class="d-flex">
                @endif
                    <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                 @if($data->img_features==null)
                      <img 
                      src="{{asset('images/default.jpg')}}" alt="{{$data->title}}"
                        style="width: 100%;height: 35vh; border-radius: 7px"
                      />
                  @else
                   <img 
                     src="{{$imgTopStoiries[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                        style="width: 100%;height: 35vh; border-radius: 7px"
                      />
                  @endif
                    </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                    <button class="btn btn-danger">{{$data->newspaper}}</button>
                    <h3 class="news-title text-white mt-1">{!! strip_tags($data->title) !!}</h3>
                    <span class="date text-white">{{date('l, d-m-Y', strtotime($data->date))}}</span>
                    <h1 class="line"></h1>
                    <p class="news-description text-white">
                      {!! strip_tags($data->description) !!}
                    </p>
                  </div>
               </a>
             </div>
          @endforeach
        </div>
      </section>
    @endif

      <!---------------------------------------------------- Ends TOP STORIES Content ------------------------------------------------>

       <!---------------------------------------------------- Starts International Content ------------------------------------------------>
       @if($showInternationalNews->isEmpty())
       <div></div>
       @else
        <section class="international">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-title">
                <h4 style="color: #fff;margin-left: 10px;">INTERNATIONAL</h4>
            </div>
          </div>
          <div class="d-flex">
           @foreach($showInternationalNews as $data)
              @php
                    $imgInternational = json_decode($data->img_features);
              @endphp
                @if(session()->has('currentUser_MobileAkhbaar'))
                  <a  href="{{route('detailNewsWeb',$data->news_id)}}" >
                    @else
                      <a href="{{url('userLogin/')}}/{{$data->news_id}}">
                @endif
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cols">
                       @if($data->img_features==null)
                        <img class="nations-image" 
                           src="{{asset('images/default.jpg')}}" alt="{{$data->title}}"
                            style="width: 100%; border-radius: 7px;height: 11rem;"
                          />
                       @else
                        <img class="nations-image" 
                            src="{{$imgInternational[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                            style="width: 100%; border-radius: 7px;height: 11rem !important"
                          />
                       @endif
                      <button class="news-btn btn btn-danger">{{$data->newspaper}}</button>
                      <h3 class="news-title text-white mt-1">{!! strip_tags($data->title) !!}</h3>
                      <span class="date text-white">{{date('l, d-m-Y', strtotime($data->date))}}</span><br>
                      <a class="more-link d-none" href="#">Read More ></a>    
                    </div>
                  </a>
            @endforeach
          </div>
        </section>
      @endif

      <!---------------------------------------------------- Ends International Content ------------------------------------------------>
      <!---------------------------------------------------- Starts Politics Content ------------------------------------------------>
      @if($showPoliticsNews->isEmpty())
       <div></div>
      @else
        <section class="politics" >
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-title">
              <h4 style="color: #fff;margin-left: 10px;">POLITICS</h4>
          </div>
        </div>
        <div class="d-flex">
                @php
                $imgPolitics = json_decode($showPoliticsNews[0]->img_features);
                @endphp
                <div class="col-xl-5 col-lg-5 col-md-5 col-xs-5 col-5 mt-4">
                     @if(session()->has('currentUser_MobileAkhbaar'))
                    <a  href="{{route('detailNewsWeb',$data->news_id)}}" >
                      @else
                      <a href="{{url('userLogin/')}}/{{$data->news_id}}">
                    @endif
                        @if($showPoliticsNews[0]->img_features==null)
                        <img 
                            src="{{asset('images/default.jpg')}}" alt="{{$data->title}}"
                            style="width: 100%;height: 55vh; border-radius: 7px;margin-top: -1rem;height: 9rem;"
                          />
                        @else
                         <img 
                            src="{{$imgPolitics[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                            style="width: 100%;height: 55vh; border-radius: 7px;margin-top: -1rem;"
                          />
                        @endif
                        <h3 class="news-title text-white mt-1">{!! strip_tags($showPoliticsNews[0]->title) !!}</h3>
                    </a> 
                </div>
                  <div class="col-xl-7 col-lg-7 col-md-7 m-sm-7 col-xs-7 col-7">
                     <div class="outer-cols d-flex flex-wrap">
                       @foreach($showPoliticsNews as $data)
                        @php
                        $imgPolitics_2 = json_decode($data->img_features);
                        @endphp
                        @if($loop->iteration>1)
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4 d-flex mt-1">
                           
                                @if(session()->has('currentUser_MobileAkhbaar'))
                                <a  href="{{route('detailNewsWeb',$data->news_id)}}" >
                                @else
                                <a href="{{url('userLogin/')}}/{{$data->news_id}}">
                                @endif
                                @if($data->img_features==null)
                                 <img 
                                 src="{{asset('images/default.jpg')}}" alt="{{$data->title}}"
                                  style="width: 100%; border-radius: 7px;height: 9rem;"
                                  />
                                @else
                                 <img 
                                  src="{{$imgPolitics_2[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                                  style="width: 100%;border-radius: 7px;height: 9rem;"
                                  />
                                @endif
                                  <h3 class="news-title text-white mt-1">{{$data->title}}</h3>
                                </a>
                          </div>
                          @endif
                        @endforeach
                     </div>
                  </div>
        </div>
      </section>
    @endif 
      <!---------------------------------------------------- Ends Politics Content ------------------------------------------------>
      <!---------------------------------------------------- Starts National Content ------------------------------------------------>
      
       <section class="national">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-title">
              <h4 style="color: #fff;margin-left: 10px;">NATIONAL</h4>
          </div>
        </div>
        <div class="d-flex">
           @foreach($showNationalNews as $data)
              @php
                    $imgnational = json_decode($data->img_features);
              @endphp
                @if(session()->has('currentUser_MobileAkhbaar'))
                  <a  href="{{route('detailNewsWeb',$data->news_id)}}" >
                    @else
                      <a href="{{url('userLogin/')}}/{{$data->news_id}}">
                @endif
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cols">
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
                      <button class="news-btn btn btn-danger">{{$data->newspaper}}</button>
                      <h3 class="news-title text-white mt-1">{!! strip_tags($data->title) !!}</h3>
                      <span class="date text-white">{{date('l, d-m-Y', strtotime($data->date))}}</span><br>
                      <a class="more-link d-none" href="#">Read More ></a>    
                    </div>
                  </a>
            @endforeach
          </div>
      </section>

      <!---------------------------------------------------- Ends National Content ------------------------------------------------>
      <!---------------------------------------------------- Starts Sports Content ------------------------------------------------>
      
 @if($showSportsNews->isEmpty())
       <div></div>
    @else
      <section class="sports">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-title">
              <h4 style="color: #fff;margin-left: 10px;">SPORTS</h4>
          </div>
        </div>  
        <div class="d-flex" style="margin-left: -1rem;">
          @foreach($showSportsNews as $data)
            @php
            $imgSports = json_decode($data->img_features);
            @endphp
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
               @if(session()->has('currentUser_MobileAkhbaar'))
                  <a href="{{route('detailNewsWeb',$data->news_id)}}" class="d-flex">
                @else
                 <a href="{{url('userLogin/')}}/{{$data->news_id}}" class="d-flex">
                @endif
                    <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                 @if($data->img_features==null)
                      <img 
                      src="{{asset('images/default.jpg')}}" alt="{{$data->title}}"
                        style="width: 100%;height: 35vh; border-radius: 7px"
                      />
                  @else
                   <img 
                     src="{{$imgSports[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                        style="width: 100%;height: 35vh; border-radius: 7px"
                      />
                  @endif
                    </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                    <button class="btn btn-danger">{{$data->newspaper}}</button>
                    <h3 class="news-title text-white mt-1">{!! strip_tags($data->title) !!}</h3>
                    <span class="date text-white">{{date('l, d-m-Y', strtotime($data->date))}}</span>
                    <h1 class="line"></h1>
                    <p class="news-description text-white">
                      {!! strip_tags($data->description) !!}
                    </p>
                  </div>
               </a>
             </div>
          @endforeach
        </div>
      </section>
    @endif
      <!---------------------------------------------------- Ends Sports Content ------------------------------------------------>

</script>
</body>
</html>
 
@include('Layouts.footer')