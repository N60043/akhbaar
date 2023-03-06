<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Newspaper</title>
  </head>
<body>
@extends('AdminPanel.dashboard.admin_dashboard')
@section('main_content') 
                <div class="card mt-3" >
                    <div class="card-header" style="width: 100%">
                        <h5>Edit Newspaper
                              <a href="{{url('viewNewspaper')}}" class="btn btn-danger btn-sm float-right">Close</a>
                        </h5>
                        
                    </div>
                 <div class="card-body" style="width: 100%">
                    <form method="POST" action="{{url('updateNewspaperRecord/')}}/{{$editNewspapar_Info->newspaper_id}}" class="editnews-form" id="editnews-form" enctype="multipart/form-data">
                       <input type="hidden" name="_method" value="PUT" />
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                 <label>Name:</label>
                                  <input autocomplete="off" type="text" class="form-control" placeholder="Name" name="name" value="{{$editNewspapar_Info->name}}" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Icon:</label>
                                    <input autocomplete="off" type="file" class="form-control" placeholder="" name="image" accept="image/*"  >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                 <label>Is Active:</label>
                                  <select class="form-control input-c" id="inlineFormSelectPref" name="is_active" >
                                    <option selected >{{$editNewspapar_Info->is_active}}
                                    </option>
                                     <option value="0">In_Active</option>
                                     <option value="1">Active</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                 <label>Is Urdu:</label>
                                  <select class="form-control input-c" id="inlineFormSelectPref" name="is_urdu" >
                                    <option selected >{{$editNewspapar_Info->is_urdu}}</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                  </select>
                                </div>
                            </div>
                           
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <button type="submit" class="btn btn-primary btn-sm float-right">Update</button>
                                
                            </div>
                        </div>
                    </form>
                        
                </div>
                    
                </div>
             
@endsection
</body>
</html>