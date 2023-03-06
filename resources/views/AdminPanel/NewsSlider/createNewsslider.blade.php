
<html>
<head>
<title>Create News Mapping</title>

</head>
<body>
@extends('AdminPanel.dashboard.admin_dashboard')
@section('main_content') 

<div class="card">
    <div class="card-body " style="width: 100%">
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
       

             <form method="POST" action="{{url('storenewsslider')}}" id="createnews-form" class="px-md-2"  enctype="multipart/form-data">
                @csrf
                                <div class="form-group mb-2">
                                    <label>Newspaper Id:</label>
                                   
                                     <select class="form-control input-c" id="inlineFormSelectPref" name="newspaper_id" required="true" value="{{old('newspaper_id')}}">
                                    <option value="">Choose One</option>
                                   
                                    
                                       @foreach($newspaper_user as $data)
                                          <option value="{{$data->id}}">
                                              <?= $data->id.". ".$data->name ?>
                                             
                                            </option>
                                        @endforeach
                                          
                                  </select>
                                </div>
                                <div class="form-outline mb-4">
                                     <label class="form-label" for="form3Example1q" >Title:</label>
                                    <input type="text" id="form3Example1q" class="form-control" name="title" value="{{old('title')}}"  required />
                                    
                                </div>
                                <div class="form-outline mb-4">
                                     <label class="form-label" for="form3Example1q" >Description:</label>
                                    <textarea class="form-control ng-pristine ng-valid ng-not-empty ng-touched "  name="descript" value={{old('descript')}} required="true"></textarea>
                                    
                                </div>
                                  <div class="form-outline mb-4">
                                     <label class="form-label" for="form3Example1q">Image:</label>
                                    <input type="file" id="form3Example1q" class="form-control" name="image"  accept="image/*" value="{{old('image')}}"  required="true" />
                                  </div>
                                  <div class="form-outline mb-4">
                                      <label class="form-label" for="form3Example1q">Is Active:</label>
                                        <select class="form-control input-c" id="inlineFormSelectPref" name="is_active" value="{{old('is_active')}}" required="true">
                                          <option value="">Choose One</option>
                                          <option value="0">De_Active</option>
                                          <option value="1">Active</option>
                                          
                                        </select>
                                       
                                </div>
                                <div class="form-outline mb-4">
                                      <label class="form-label" for="form3Example1q">Is Urdu:</label>
                                        <select class="form-control input-c" id="inlineFormSelectPref" name="is_urdu" value="{{old('is_urdu')}}" required="true">
                                          <option value="">Choose One</option>
                                          <option value="0">English</option>
                                          <option value="1">Urdu</option>
                                          
                                        </select>
                                       
                                </div>
                                 <div class="form-outline mb-4">
                                     <label class="form-label" for="form3Example1q" >Slider Order:</label>
                                    <input type="text" id="form3Example1q" class="form-control" name="slider_order" value="{{old('slider_order')}}"  required />
                                    
                                </div>
                                    <div class="col-md-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary float-right">Save</button>
                               </div>
                        
               </form>

          
        </div>
        </div>
<!------------------------------Script for text Editor --------------------------->
<script src="{{asset('texteditor_plugin/ckeditor.js')}}"></script>
<script>
  CKEDITOR.replace('descript');
</script>
@endsection