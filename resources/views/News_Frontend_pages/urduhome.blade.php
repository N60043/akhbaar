 @include('Layouts.header')
 <!DOCTYPE html>
<html >
<head>
  <title>Home</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="Content_page" style="background: black;">
  <div class="grand_parent" >
      <div class="parents">
        <div class="child">
          <div  id="carouselExampleIndicators"  class="carousel slide " style=""  data-ride="carousel" data-interval="5000">
            <ol class="carousel-indicators" style="display: -webkit-inline-box;">
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
                <div class="carousel-caption   d-md-block md-auto " id="carousel_1">
               <button class="btn" id="btn_breakingNews">BREAKING NEWS</button>
              </div>
              <div class="carousel-caption  d-md-block md-auto " >
                  <button class="btn " id="btn_News_carousal" style="margin-left: 39rem !important;">{{$data->newspaper}}</button>
                  <h4 class="caption_1 text-right mt-3" style="direction: rtl;width: 700px;margin-left: 2rem !important;">{{$data->title}}</h4>
                  <p class="caption_2 text-right mt-2" style="font-size: 16px;direction: rtl;width: 700px;margin-left: 2rem !important;">{!! strip_tags($data->description) !!}</p>
              </div>
            @else
                <img src="{{$imgSlider[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}" width="100%" height="622px">
                <div class="carousel-caption   d-md-block md-auto " id="carousel_1">
               <button class="btn" id="btn_breakingNews">BREAKING NEWS</button>
              </div>
              <div class="carousel-caption  d-md-block md-auto " style="">
                  <button class="btn" id="btn_News_carousal" style="margin-left: 39rem !important;">{{$data->newspaper}}</button>
                  <h4 class="caption_1 text-right text-justify mt-2" style="direction: rtl;width: 700px;margin-left: 2rem !important;">{{$data->title}}</h4>
                  <p class="caption_2 text-right text-justify mt-2" style="font-size: 16px;direction: rtl;width: 700px;margin-left: 2rem !important;">{!! strip_tags($data->description) !!}</p>
              </div>
               @endif
              </a>
             </div>
            
          @endforeach 
          </div>
         </div>
        </div>
        
        <div class="child" style="" scrollmenu id="trending_news">
          <h4 class="trending_news_heading" >TRENDING NEWS</h4>
          <?php $i = 1; ?>
          @foreach($showTrendingNews as $key=>$data)
          <div class="col-md-12" id="trending_news_list" style="">
            <span id="UrduSpan_Count">0<?= $i; ?></span>
            
             @if(session()->has('currentUser_MobileAkhbaar'))
                  <a class="text-decoration-none text-white" href="{{route('detailNewsWeb',$data->news_id)}}">
                  @else
                  <a class="text-decoration-none text-white" href="{{url('userLogin/')}}/{{$data->news_id}}">
                  @endif
              <h4 class="text-right" style="direction: rtl;">{{$data->urdu_name}}</h4>
              <p class="font-weight-light text-right float-right" style="font-size: 14px;direction: rtl;margin-right: 42px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;"><strong style="font-weight: bold;">{{$data->title}}</strong><?= " " ?>{!! strip_tags($data->title) !!}</p>
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
        <a class="text-decoration-none" href="{{route('UrduAkhbaar',$data->id)}}">
            <img class="mt-2" src="{{asset('uploads/')}}/{{$data->icon}}" width="10%" title='{{$data->name}}'id="middle-bar-items-img">
            <div class="middle-bar-items middle-bar-items-1" id="box-1">
              <span class="ml-3 w-50" id="middle-bar-items-mainHeading">{{Str::upper($data->name)}}</span>
            </div>
          </a>
          @endforeach
      </div>
    </a>
  </div>
</div>
      <!----------------------------------------------------  Ends Middle Bar Content ------------------------------------------------>
      <!---------------------------------------------------- STARTS TOP-STORIES Content ------------------------------------------------>
    <div class="container-fluid bgclr-cls">
        @if($showTopStories->isEmpty())
        <div></div>
        @else
        <section class="top-stories">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-title_Urdu">
              <h4 style="color: #fff; margin-left: 10px">{{$showTopStories[0]->urdu_name}}</h4>
            </div>
          </div>
         <div class="d-flex" >
          @foreach($showTopStories as $data)
            @php
            $imgTopStoiries = json_decode($data->img_features);
            @endphp
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6" style="direction: rtl;margin-left:1rem">
               @if(session()->has('currentUser_MobileAkhbaar'))
                  <a href="{{route('detailNewsWeb',$data->news_id)}}" class="d-flex">
                @else
                 <a href="{{url('userLogin/')}}/{{$data->news_id}}" class="d-flex">
                @endif
                    <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                 @if($data->img_features==null)
                      <img 
                      src="{{asset('images/default.jpg')}}" alt="{{$data->title}}"
                        style="width: 100%;height: 35vh; border-radius: 17px"
                      />
                  @else
                   <img 
                     src="{{$imgTopStoiries[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                        style="width: 100%;height: 35vh; border-radius: 17px"
                      />
                  @endif
                    </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                    <button class="btn btn-danger">{{$data->newspaper}}</button>
                    <h3 class="news-title-urdu text-white">{!! strip_tags($data->title) !!}</h3>
                    <span class="date text-white">{{date('l, d-m-Y', strtotime($data->date))}}</span>
                    <h1 class="line"></h1>
                    <p class="news-description-urdu text-white">
                      {!! strip_tags($data->description) !!}
                    </p>
                  </div>
               </a>
             </div>
          @endforeach
        </div>
        </section>
        @endif
      </div>

      <!---------------------------------------------------- Ends TOP STORIES Content ------------------------------------------------>

      <!---------------------------------------------------- Starts International Content ------------------------------------------------>
       @if($showInternationalNews->isEmpty())
       <div></div>
       @else
      <section class="international">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-title_Urdu">
            <h4 style="color: #fff; margin-left: 10px">{{$showInternationalNews[0]->urdu_name}}</h4>
          </div>
        </div>
        <div class="d-flex " style="direction:rtl">
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
                            style="width: 100%; border-radius: 10px;height: 11rem;"
                          />
                       @else
                        <img class="nations-image" 
                            src="{{$imgInternational[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                            style="width: 100%; border-radius: 10px;height: 11rem !important"
                          />
                       @endif
                      <button class="news-btn btn btn-danger">{{$data->newspaper}}</button>
                      <h3 class="news-title-urdu text-white">{!! strip_tags($data->title) !!}</h3>
                      <span class="date text-white">{{date('l, d-m-Y', strtotime($data->date))}}</span><br>
                      <a class="more-link d-none" href="#"style="float: left;direction: ltr;">Read More -></a>    
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
      <section class="politics">
        <div class="row">
          <div
            class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-title_Urdu colss"
          >
            <h4 style="color: #fff; margin-left: 10px">{{$showPoliticsNews[0]->urdu_name}}</h4>
          </div>
        </div>
          <div class="d-flex" style="direction: rtl;">
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
                            style="width: 100%;height: 55vh; border-radius: 17px;margin-top: -1rem;"
                          />
                        @else
                         <img 
                            src="{{$imgPolitics[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                            style="width: 100%;height: 55vh; border-radius: 17px;margin-top: -1rem;"
                          />
                        @endif
                        <h3 class="news-title-urdu text-white">{!! strip_tags($showPoliticsNews[0]->title) !!}</h3>
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
                                  style="width: 100%; border-radius: 17px;height: 9rem;"
                                  />
                                @else
                                 <img 
                                  src="{{$imgPolitics_2[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                                  style="width: 100%;border-radius: 17px;height: 9rem;"
                                  />
                                @endif
                                  <h3 class="news-title-urdu text-white">{{$data->title}}</h3>
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
@if($showNationalNews->isEmpty())
       <div></div>
       @else
      <section class="national">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-title_Urdu">
            <h4 style="color: #fff; margin-left: 10px">{{$showNationalNews[0]->urdu_name}}</h4>
          </div>
        </div>
      <div class="d-flex" style="direction: rtl;">
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
                            style="width: 100%; border-radius: 10px;height: 11rem;"
                          />
                       @else
                        <img class="nations-image" 
                            src="{{$imgnational[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                            style="width: 100%; border-radius: 10px;height: 11rem !important;"
                          />
                       @endif
                      <button class="news-btn btn btn-danger">{{$data->newspaper}}</button>
                      <h3 class="news-title-urdu text-white">{!! strip_tags($data->title) !!}</h3>
                      <span class="date text-white">{{date('l, d-m-Y', strtotime($data->date))}}</span><br>
                      <a class="more-link d-none" href="#" style="float: left;direction: ltr;">Read More -></a>    
                    </div>
                  </a>
            @endforeach
          </div>
      </section>
@endif
      <!---------------------------------------------------- Ends National Content ------------------------------------------------>
      <!---------------------------------------------------- Starts Sports Content ------------------------------------------------>
@if($showSportsNews->isEmpty())
       <div></div>
       @else
      <section class="sports">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-title_Urdu">
            <h4 style="color: #fff; margin-left: 10px">{{$showSportsNews[0]->urdu_name}}</h4>
          </div>
        </div>
         <div class="d-flex mt-2">
          @foreach($showSportsNews as $data)
            @php
            $imgSports = json_decode($data->img_features);
            @endphp
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6" style="direction: rtl;margin-left:1rem">
               @if(session()->has('currentUser_MobileAkhbaar'))
                  <a href="{{route('detailNewsWeb',$data->news_id)}}" class="d-flex">
                @else
                 <a href="{{url('userLogin/')}}/{{$data->news_id}}" class="d-flex">
                @endif
                    <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                 @if($data->img_features==null)
                      <img 
                      src="{{asset('images/default.jpg')}}" alt="{{$data->title}}"
                        style="width: 100%;height: 35vh; border-radius: 17px"
                      />
                  @else
                   <img 
                     src="{{$imgSports[0]->img ?? asset('images/default.jpg')}}" alt="{{$data->title}}"
                        style="width: 100%;height: 35vh; border-radius: 17px"
                      />
                  @endif
                    </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                    <button class="btn btn-danger">{{$data->newspaper}}</button>
                    <h3 class="news-title-urdu text-white">{!! strip_tags($data->title) !!}</h3>
                    <span class="date text-white">{{date('l, d-m-Y', strtotime($data->date))}}</span>
                    <h1 class="line"></h1>
                    <p class="news-description-urdu text-white">
                      {!! strip_tags($data->description) !!}
                    </p>
                  </div>
               </a>
             </div>
          @endforeach
        </div>
      </section>
@endif
</body>
</html>
 
@include('Layouts.footer')