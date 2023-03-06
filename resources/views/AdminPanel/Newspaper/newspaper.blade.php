
<html>
  <head>
    <title>Newspaper</title>


  </head>
<body>
@extends('AdminPanel.dashboard.admin_dashboard')
@section('main_content') 
   <div class="container col-12" style="position: absolute;">
        <div class="row" style="width: 100%;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form  method="get" class="mt-3" action="{{url('viewNewspaper')}}" id="search_form">
                            <div class="input-group rounded col-md-3 float-right"  >
                              <input type="search" name="search" class="form-control rounded" style="font-size: 12px" placeholder="Search Name" aria-label="Search" value="{{$search}}" />
                             <input type='submit' class="btn btn-primary ml-1" id='btnsearch' value='Search'>
                           </div>
                         </form>
                        <h5>
                              <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#createModal">
                                 Create Newspaper
                              </button>
                        </h5>
                        <br/>
                       
                        
                    </div>
                    <div class="card-body">
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
                             
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Is_Active</th>
                            <th scope="col">Is_Urdu</th>
                            <th scope="col">Action</th>
                          </tr>

                        </thead>
                        <tbody >
                          @forelse($newspaper_Data as $data) 
                          
                            <tr>
                            <td>{{$data->newspaper_id}}</td>
                            <td>{{$data->name}}</td>
                           
                              <td>
                                     <img src="{{url('uploads/')}}/{{$data->icon}}" alt="image" height="20";width="20">
                              
                            </td>
                            
                            <td>
                              @if($data->is_active=='1')
                                <span class="rounded col-3" style="background: lightgreen;height: 10px;padding: 4px;">Active</span>
                              @endif
                               @if($data->is_active=='0')
                                <span class="rounded col-3" style="background:#EA3838;height: 10px;padding: 4px;color: white;">In-Active</span>
                              @endif

                            </td>
                            <td>{{$data->is_urdu}}</td>
                            <td>
                              <a href="{{url('editNewspaper/')}}/{{$data->newspaper_id}}" type="button" class="btn btn-primary">Edit</a>
                              |
                               <a href="{{url('deleteNewspaper/')}}/{{$data->newspaper_id}}" type="button" class="btn btn-danger">Delete</a>
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
                      {{$newspaper_Data->links('vendor.customPagination')}}
                    </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
         
     </div>
  
<!--------------------------------------------------- Create News Model------------------------------------------------>
<div id="createModal" class="modal" data-backdrop="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
      </div>
      <div class="modal-body">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Create New Newspaper</h3>

             <form method="POST" action="{{url('createnewspaper')}}" id="createnews-form" class="px-md-2" enctype="multipart/form-data" >
                      @csrf
                      <div class="form-outline mb-4">
                         <label class="form-label" for="form3Example1q" >Name:</label>
                        <input type="text" id="form3Example1q" class="form-control" name="name"  required />
                        
                      </div>
                      <div class="form-outline mb-4">
                         <label class="form-label" for="form3Example1q">icon:</label>
                        <input type="file" id="form3Example1q" class="form-control" name="image"  accept="image/*"   required />
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <label class="form-label" for="form3Example1q">Is Active:</label>
                            <select class="form-control input-c" id="inlineFormSelectPref" name="is_active" required="true">
                              <option value="">Choose One</option>
                              <option value="0">De_Active</option>
                              <option value="1">Active</option>
                              
                            </select>
                           
                         </div>
                        
                          <div class="col-12">
                            <br/>
                             <label class="form-label" for="form3Example1q">Is Urdu:</label>
                            <select class="form-control input-c" id="inlineFormSelectPref" name="is_urdu" required="true">
                              <option value="">Choose One</option>
                              <option value="0">0</option>
                              <option value="1">1</option>
                             
                            </select>
                            
                         </div>

                      
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