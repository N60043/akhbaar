
<html>
  <head>
    <title>News Mapping</title>
  </head>
<body>
@extends('AdminPanel.dashboard.admin_dashboard')
@section('main_content')                     
   <div class="container col-12" style="position: absolute;">
        <div class="row" style="width: 99%;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <form  method="get" action="" id="search_form" >
                        @csrf
                            <div class="input-group rounded col-md-3 mt-3 float-right"  >
                              <input type="search" name="search" class="form-control rounded" style="font-size: 10px;" placeholder="Search News Category Name" aria-label="Search" value="{{$search}}" />
                             <input type='submit' class="btn btn-primary ml-1" id='btnsearch' value='Search'>
                           </div>
                         </form>
                        <h5>
                            <a href="{{url('createnewsmapping')}}" >
                              <button type="button" class="btn btn-primary ">
                                 Create News Category Mapping
                              </button>
                            </a>
                        </h5>
                        <br/>
                       
                        
                    </div>
                    <div class="card-body" style="border:width: 97%;" >
                      <table class="table table-bordered" style="margin-top: 20px;">
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
                            <th scope="col">Newsmapping_Id</th>
                            <th scope="col">Newspaper_Id</th>
                            <th scope="col" class="col-md-2">Newspaper_Category_Id</th>
                            <th scope="col" class="col-md-2">Newspaper_Category_Name</th>
                            <th scope="col" class="col-md-2">News_Category_Id</th>
                            <th scope="col">Category Url</th>
                            <th scope="col">Action</th>

                          </tr>

                        </thead>
                        <tbody class="tbody">
                        
                          @forelse($newsMapping_user as $data) 
                         
                            <tr style="font-size:12px;">
                            <td>{{$data->id}}</td>
                            <td>{{$data->newspaper_id}}</td>
                            <td>{{$data->newspaper_cat_id}}</td>
                            <td>{{$data->newspaper_cat_name}}</td>
                            <td>{{$data->news_category_id}}</td>
                            <td>{{$data->category_url}}</td>
                            <td>
                              <a href="{{url('editNewsmapping')}}/{{$data->id}}" type="button" class="btn btn-primary" >Edit</a>
                            </td>
                            <td>
                                   <a href="{{url('deleteNewsmapping/')}}/{{$data->id}}" type="button" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                            @empty
                                <h6 style="color:red;text-align:center">{{$search}} Not Found Plears Search Correct Data</h6>
                            </td>
                          </tr>

                          @endforelse
                          
                        </tbody>
                    </table>
                    <div class="row justify-content-center">
                       {{$newsMapping_user->links('vendor.customPagination')}}
                    </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
         
     </div>
 

 @endsection
</body>
</html>