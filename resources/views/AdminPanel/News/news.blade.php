
<html>
  <head>
  <title>News</title>
 
</head>
<body>
@extends('AdminPanel.Dashboard.admin_dashboard')
@section('main_content')                              
   <div class="container col-12 mt-3" style="position: absolute;">
        <div class="row" style="width: 100%;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <form  action="{{url('viewNews')}}" method="GET" id="search_form" >
                        @csrf
                            <div class="input-group rounded col-md-3 mt-3 float-right"  >
                              <input type="search" name="search" class="form-control rounded" style="font-size: 12px;" placeholder="Search Title" aria-label="Search" value="{{$search}}" />
                             <button type='submit' class="btn btn-primary ml-1" id='btnsearch' >Search</button>
                           </div>
                       </form>
                        <h5>
                               <a href="{{url('createNews')}}" type="button" class="btn btn-primary" >Create News</a>
                        </h5>
                       
                        <br/>
                       
                        
                    </div>
                   <div>
                   <div class="card-body">
                    <div class="row">
                     <div style="border: 1px solid lightgray;width: 97%;" >
                       <table class="table table-responsive table-bordered table-sm " style="margin-top: 20px;">
                        <thead class="thead">
                           {{-- Message --}}
                                @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Success !</strong> {{ session('success') }}
                                </div>
                                @endif

                                @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Error !</strong> {{ session('error') }}
                                </div>
                                @endif
                          <tr class="table_content" style="font-size:12px;">
                            <th scope="col">News_Id</th>
                            <th class="col-md-4">News_Uploader_Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Summary</th>
                            <th scope="col">Description</th>
                             <th scope="col">Is Urdu</th>
                            <th scope="col">Image</th>
                            <th scope="col">News Vedeo</th>
                            <th scope="col">Tag</th>
                            <th scope="col">Status</th>
                            <th scope="col">Guid</th>
                            <th class="col-md-4">Date</th>
                            <th scope="col" class="col-md-2">News_Category_Id</th>
                            <th scope="col">Newspaper_Id</th>
                            <th scope="col" class="col-md-2">News_Speciality_Id</th>
                            <th scope="col">Breaking_News</th>
                            <th scope="col">Publish_Timestamp</th>
                            <th class="col" class="col-md-6">Edit</th>
                            <th class="col" class="col-md-6">Delete</th>

                          </tr>

                        </thead>
                        <tbody class="tbody">
                         
                          @forelse($news_user as $data) 
                          
                            <tr style="font-size:12px;">
                            <td>{{$data->news_id}}</td>
                            <td >{{$data->news_uploader_id}}</td>
                            <td>{{$data->title}}</td>
                            <td>{{$data->summary}}</td>
                            <td>{!! $data->description !!}</td>
                            <td>{{$data->is_urdu}}</td>
                            <td>
                                @if($data['image']!='')
                                     <img src="{{asset('uploads/')}}/{{$data->image}}" alt="image" height="20";width="20">
                                @else
                                     <img src="{{asset('image/user.png')}}" alt="image" height="20";width="20">
                                @endif
                             
                            </td>
                             <td class="col-3"> 
                                <iframe  style="height: 10%" src="uploadsVedeo/{{$data->news_Vedeo}}" alt="vedeo" /></iframe>
                            </td>
                            <td>{{$data->tag}}</td>
                            <td>{{$data->status}}</td>
                            <td>{{$data->guid}}</td>
                            <td class="col-md-4">{{$data->date}}</td>
                            <td>{{$data->news_category_id}}</td>
                            <td>{{$data->newspaper_id}}</td>
                            <td>{{$data->news_speciality_id}}</td>
                            <td>
                              @if($data->breaking_news=='Active')
                                <span class="rounded col-3" style="background: lightgreen;height: 10px;padding: 4px;">Active</span>
                              @endif
                               @if($data->breaking_news=='In_Active')
                                <span class="rounded col-3" style="background:#EA3838;height: 10px;padding: 4px;color: white;">In-Active</span>
                              @endif
                            </td>
                            <td>
                              @if($data->publish_timestamp=='1')
                                <span class="rounded col-3" style="background: lightgreen;height: 10px;padding: 4px;">Publish</span>
                              @endif
                               @if($data->publish_timestamp=='0')
                                <span class="rounded col-3" style="background:#EA3838;height: 10px;padding: 4px;color: white;">Un_Publish</span>
                              @endif

                            </td>
                            
                            <td class="col-md-12">
                              <a href="{{url('editNews/')}}/{{$data->news_id}}" type="button" class="btn btn-primary" >Edit</a>
                            </td>
                            <td>
                                   <a href="{{url('deleteNews/')}}/{{$data->news_id}}" type="button" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                            @empty
                                <h6 class="mt-4" style="color:red;font-siz:20px;text-align:center">{{$search}} is Not Found Plears Search Correct Data</h6>
                            </td>
                          </tr>

                         @endforelse
                        </tbody>
                      </table>
                      
                    </div>
                    <div class="col-md-12 justify-content-center">
                        {{$news_user->links('vendor.customPagination')}}
                    </div>
                 </div>
                </div>
                </div>
                </div>
                
            </div>
            
        </div>
         
     </div>

@endsection
</body>
</html>