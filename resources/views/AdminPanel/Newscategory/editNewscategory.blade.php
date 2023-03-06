<!doctype html>
<html lang="en">
  <head>
   
    <title>Edit NewsCategories</title>
  </head>
<body>
@extends('AdminPanel.dashboard.admin_dashboard')
@section('main_content') 
<div class="card mt-3">
    <div class="card-body " style="width: 100%">
                        <h5>Edit News Category
                              <a href="{{url('viewNewsCategory')}}" class="btn btn-danger btn-sm float-right" >Close</a>
                        </h5>
                        
                    </div>
                 <div class="card-body" style="width:100%">
                     <form method="POST" action="{{url('updateNewscategoryRecord/')}}/{{$edit_newscategory->categoryid}}" class="editnewscategory-form" id="editnewscategory-form" >
                     <input type="hidden" name="_method" value="PUT" />
                     @csrf
                         <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>News Name:</label>
                                 <input autocomplete="off" type="text" class="form-control" placeholder="" name="eng_name" value="{{$edit_newscategory->name}}" >
                                </div>
                            </div>
        
                             <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Urdu Name:</label>
                                   <input autocomplete="off" type="text" class="form-control" placeholder="" name="urdu_name" value="{{$edit_newscategory->urdu_name}}" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Sort by:</label>
                                <input autocomplete="off" type="text" class="form-control" placeholder="" name="sort_by" value="{{$edit_newscategory->sort_by}}" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">

                                </div>
                            </div>
        
         
                     <div class="col-md-12">
                                
                                <button type="submit" class="btn btn-primary btn-sm float-right">Update</button>
                                
                            </div>
                    
        
           
        </form>
    </div>
        
       </div>

         
     </div>
@endsection
</body>
</html>

