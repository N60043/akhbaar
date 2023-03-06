 <div class="col-6 d-flex flex-row rounded" id="politics_firstBlog" style="width:38%">
             @foreach($showPoliticsNews as $data)
             
              @php
              $imgPolitics = json_decode($data->img_features);
              @endphp
             @if(session()->has('currentUser_MobileAkhbaar'))
                <a class="text-decoration-none" width="100%" href="{{route('detailNewsWeb',$data->news_id)}}">
                @else
                <a class="text-decoration-none" width="100%" href="{{url('userLogin/')}}/{{$data->news_id}}">
              @endif
                @if($data->news_Vedeo)
                <iframe id="iframe_politics" class="responsive-iframe rounded" src="{{asset('uploadsVedeo')}}/{{$data->news_Vedeo}}" >
                </iframe>
                @else
                @if($data->img_features==null)
                    <img src="{{asset('images/default.jpg')}}" id="img_null_politics" alt="{{$data->title}}" height="90%" >
                    @else
                    <img src="{{$imgPolitics[0]->img ?? asset('images/default.jpg')}}" id="img_notnull_politics" alt="{{$data->title}}" height="90%" >
                    @endif
                
              @endif
                <h4 id="iframe_politics_heading" class="position-absolute ml-5 top-100 start-0 translate-middle" >
                  {{$data->title}}
                </h4>
            </a>
             @endforeach
            </div>