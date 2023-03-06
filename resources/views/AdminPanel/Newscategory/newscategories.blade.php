<html>
  <head>
    <title>NewsCategories</title>


  </head>
<body>
@extends('AdminPanel.dashboard.admin_dashboard')
@section('main_content') 
   <div class="container md-4"  style="position: absolute;">
        <div class="row" style="width: 100%;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <form  method="get" action="" id="search-form">
                       <div class="input-group rounded col-md-3 mt-2 col-sm-2 float-right" >
                          <input type="search" name="search" class="form-control rounded" style="font-size: 12px;" placeholder="Search News Name" aria-label="Search" value="{{$search}}" />
                         <input type='submit' class="btn btn-primary ml-1" id='btnsearch' value='Search'>
                       </div>
                     </form>
                     
                        <h5>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                                 Create NewsCategory
                              </button>
                        </h5>
                       </br>
                     </div> 
                   
                    <div class="card-body" >
                      <table class="table table-bordered" style="margin-top: 20px;">
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
                             
                            <th scope="col">News Category Id</th>
                            <th scope="col">News Name</th>
                            <th scope="col">Urdu Name</th>
                            <th scope="col">Sort By</th>
                            <th scope="col">Action</th>
                          </tr>

                        </thead>
                        <tbody >
                         
                          @forelse($datanewscategory as $data) 
                         
                            <tr>
                           
                            <td>{{$data->categoryid}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->urdu_name}}</td>
                            <td>{{$data->sort_by}}</td>
                            <td>
                              <a href="{{url('editNewsCategories/')}}/{{$data->categoryid}}" type="button" class="btn btn-primary">Edit</a>
                              |
                               <a href="{{url('deleteNewsCategories/')}}/{{$data->categoryid}}" type="button" class="btn btn-danger">Delete</a>
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
                      {{$datanewscategory->links('vendor.customPagination')}}
                    </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
         
     </div>
     
  
<!--------------------------------------------------- Create News Model------------------------------------------------>
<div class="modal" id="createModal" data-backdrop="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
      </div>
      <div class="modal-body">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Create News Category</h3>

             <form method="POST" action="{{url('createnewsCategories')}}" id="createnews-form" class="px-md-2" enctype="multipart/form-data" >
                      @csrf
                      <div class="form-outline mb-4">
                         <label class="form-label" for="form3Example1q" >English Name:</label>
                        <input type="text" id="form3Example1q" class="form-control" name="eng_name"  required />
                        
                      </div>
                      <div class="form-outline mb-4">
                         <label class="form-label" for="form3Example1q">Urdu Name:</label>
                        <input type="text" id="form3Example1q" class="form-control" name="urdu_name" required />
                       
                      </div>
                      <div class="form-outline mb-4">
                          <label class="form-label" for="form3Example1q">Sort by:</label>
                            <input type="text" id="form3Example1q" class="form-control" name="sort_by" required />
                  
                      </div>
                      <br/>
                      <button type="submit" class="btn btn-primary float-right" style="">Save</button>

               </form>

          
        </div>
        </div>
      </div>
    
    </div>
  </div>
</div>

 

@endsection
</body>
</html>


