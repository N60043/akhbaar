 @include('Layouts.header')
 <!DOCTYPE html>
<html >
<head>
<style>
.container-fluid::-webkit-scrollbar {
  display: none;
}
.national{
display:none;
}
.btn_more,.btn_less
{
  margin-left:50%;
}
#less
{
  display:none;
}
</style>
  <title>Home</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/styles.css')}}">  
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="Content_page" style="background: black;">
  <div class="container-fluid bgclr-cls">
 @if($categoryNews->isEmpty())
       <div></div>
    @else
        <section class="politics" >
        {{-- <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-title">
              <h4 style="color: #fff;margin-left: 10px;">{{$categoryNews[0]->category}}</h4>
          </div>
        </div> --}}
        <div class="d-flex ">
                @php
                $imgPolitics = json_decode($categoryNews[0]->img_features);
                @endphp
                <div class="col-xl-5 col-lg-5 col-md-5 col-xs-5 col-5 mt-4">
                     @if(session()->has('currentUser_MobileAkhbaar'))
                    <a  href="{{route('detailNewsWeb',$categoryNews[0]->news_id)}}" >
                      @else
                      <a href="{{url('userLogin/')}}/{{$categoryNews[0]->news_id}}">
                    @endif
                        @if($categoryNews[0]->img_features==null)
                        <img 
                            src="{{asset('images/default.jpg')}}" alt="{{$data->title}}"
                            style="width: 100%;height: 55vh; border-radius: 7px;margin-top: -1rem;height: 9rem;"
                          />
                        @else
                         <img 
                            src="{{$imgPolitics[0]->img ?? asset('images/default.jpg')}}" alt="{{$categoryNews[0]->title}}"
                            style="width: 100%;height: 55vh; border-radius: 7px;margin-top: -1rem;"
                          />
                        @endif
                        <h3 class="news-title text-white mt-1">{!! strip_tags($categoryNews[0]->title) !!}</h3>
                    </a> 
                </div>
                  <div class="col-xl-7 col-lg-7 col-md-7 m-sm-7 col-xs-7 col-7">
                     <div class="outer-cols d-flex flex-wrap">
                       @foreach($categoryNews as $data)
                        @php
                        $imgPolitics_2 = json_decode($data->img_features);
                        @endphp
                          @if($loop->iteration>1 && $loop->iteration<=7)
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

   {{----------------------------- more and Less Button ------------------------------------------------}}
      <button type="button" class="btn btn-danger btn-floating btn_more" id="more">
        <i class="fas fa-arrow-down"></i>
      </button>
      <button type="button" class="btn btn-danger btn-floating btn_less" id="less">
        <i class="fas fa-arrow-up"></i>
      </button>


       <section class="national" id="moreNews">
        <div class="d-flex flex-wrap" >
           @foreach($categoryNews as $data)
              @if($loop->iteration>7)
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
                        <span class="date text-white">{{date('l, d-m-Y', strtotime($data->date))}}</span><br>
                        <a class="more-link d-none" href="#">Read More ></a>    
                      </div>
                    </a>
              @endif
            @endforeach
          </div>
      </section>
  @endif
</div>
      <!---------------------------------------------------- Ends National Content ------------------------------------------------>
<script>
//var showHide = document.querySelector("more");
$('#more').click(function (e){
     var less=document.getElementById("less")
      var more=document.getElementById("more")
      var moreNews=document.getElementById("moreNews");
      moreNews.style.display="block";
      more.style.display="none";
      less.style.display="block";
});
$('#less').click(function (e){
     var more=document.getElementById("more")
      var less=document.getElementById("less")
      var LessNews=document.getElementById("moreNews");
      LessNews.style.display="none";
      less.style.display="none";
      more.style.display="block";
});
</script>
</body>
</html>
 
@include('Layouts.footer')