
<html>
  <head>
    <title>Newspaper</title>


  </head>
<body>
@extends('AdminPanel.dashboard.admin_dashboard')
@section('main_content') 
   <div class="container col-12 mt-3" style="position: absolute;">
        <div class="row" style="width: 100%;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <form  action="" method="GET" id="search_form" >
                        @csrf
                            <div class="input-group rounded col-md-3 mt-3 float-right"  >
                              <input type="search" name="search" class="form-control rounded" style="font-size: 12px;" placeholder="Search Title" aria-label="Search" value="{{$search}}" />
                             <button type='submit' class="btn btn-primary ml-1" id='btnsearch' >Search</button>
                           </div>
                       </form>
                        <h5>
                               <a href="{{url('createNewsslider')}}" type="button" class="btn btn-primary" >Create News Slider</a>
                        </h5>
                       
                        <br/>
                       
                        
                    </div>
                   <div>
                    <div class="card-body">
                      <table class="table table-bordered" style="margin-top: 20px;overflow-x: scroll;">
                        <thead >
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
                          <tr>
                             
                            <th scope="col">id</th>
                            <th scope="col">Newspaper Id</th>
                            <th scope="col">title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Is Active</th>
                            <th scope="col">Is Urdu</th>
                            <th scope="col">Slider Order</th>
                            <th scope="col">Action</th>
                          </tr>

                        </thead>
                        <tbody >
                          @forelse($newsslider_Data as $data) 
                          
                            <tr>
                            <td>{{$data->slider_id}}</td>
                            <td>{{$data->newspaper_id}}</td>
                            <td>{{$data->title}}</td>
                            <td>{!! $data->description !!}</td>
                            <td>
                                @if($data['image']!='')
                                     <img src="{{asset('uploads/')}}/{{$data->image}}" alt="image" height="20";width="20">
                                @else
                                     <img src="{{asset('image/user.png')}}" alt="image" height="20";width="20">
                                @endif
                             
                            </td>
                            
                            <td class="col-1">
                              @if($data->is_active=='1')
                                <span class="rounded col-3" style="background: lightgreen;height: 10px;padding: 4px;">Active</span>
                              @endif
                               @if($data->is_active=='0')
                                <span class="rounded col-3" style="background:#EA3838;height: 10px;padding: 4px;color: white;">In-Active</span>
                              @endif

                            </td>
                            <td>{{$data->is_urdu}}</td>
                             <td>{{$data->slider_order}}</td>
                             <td class="col-2">
                              <a href="{{url('editNewsslider/')}}/{{$data->slider_id}}" type="button" class="btn btn-primary">Edit</a>
                              |
                               <a href="{{url('deleteNewsslider/')}}/{{$data->slider_id}}" type="button" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                            @empty
                                <h6 style="color:red;text-align:center">{{$search}} is Not Found Plears Search Correct Data</h6>
                            </td>
                          </tr>

                         @endforelse
                      </tbody>
                    </table>
                    <div class="row justify-content-center">
                      {{$newsslider_Data->links('vendor.customPagination')}}
                    </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
         
     </div>

@endsection
</body>
</html>