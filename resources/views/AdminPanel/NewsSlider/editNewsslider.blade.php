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
                        <h5>Edit News Slider
                              <a href="{{url('viewNewslider')}}" class="btn btn-danger btn-sm float-right">Close</a>
                        </h5>
                        
                    </div>
                 <div class="card-body" style="width: 100%">
                    <form method="POST" action="{{url('updateNewssliderRecord/')}}/{{$editNewsslider_Info->slider_id}}" class="editnews-form" id="editnews-form" enctype="multipart/form-data">
                       <input type="hidden" name="_method" value="PUT" />
                        @csrf
                         
                         <div class="form-group mb-2">
                                    <label>Newspaper Id:</label>
                                   
                                     <select class="form-control input-c" id="inlineFormSelectPref" name="newspaper_id" >
                                    <option selected>{{$editNewsslider_Info->newspaper_id}}</option>
                                   
                                    
                                       @foreach($newspaper_user as $data)
                                          <option value="{{$data->id}}">
                                              <?= $data->id.". ".$data->name ?>
                                             
                                            </option>
                                        @endforeach
                                          
                                  </select>
                                </div>
                                <div class="form-outline mb-4">
                                     <label class="form-label" for="form3Example1q" >Title:</label>
                                    <input type="text" id="form3Example1q" class="form-control" name="title" value="{{$editNewsslider_Info->title}}"  required />
                                    
                                </div>
                                <div class="form-outline mb-4">
                                     <label class="form-label" for="form3Example1q" >Description:</label>
                                    <textarea class="form-control ng-pristine ng-valid ng-not-empty ng-touched "name="descript" >{{$editNewsslider_Info->description}}</textarea>
                                    
                                </div>
                                  <div class="form-outline mb-4">
                                     <label class="form-label" for="form3Example1q">Image:</label>
                                    <input type="file" id="form3Example1q" class="form-control" name="image"  accept="image/*" />
                                  </div>
                                  <div class="form-outline mb-4">
                                      <label class="form-label" for="form3Example1q">Is Active:</label>
                                      <select class="form-control input-c" id="inlineFormSelectPref" name="is_active">
                                          <option selected>
                                             {{$editNewsslider_Info->is_active}}
                                          </option>
                                          <option value="0">In_Active</option>
                                          <option value="1">Active</option>
                                          
                                        </select>
                                       
                                </div>
                                <div class="form-outline mb-4">
                                      <label class="form-label" for="form3Example1q">Is Urdu:</label>
                                      <select class="form-control input-c" id="inlineFormSelectPref" name="is_urdu">
                                          <option selected>
                                             {{$editNewsslider_Info->is_urdu}}
                                          </option>
                                          <option value="0">English</option>
                                          <option value="1">Urdu</option>
                                        </select>
                                       
                                </div>
                                 <div class="form-outline mb-4">
                                     <label class="form-label" for="form3Example1q" >Slider Order:</label>
                                    <input type="text" id="form3Example1q" class="form-control" name="slider_order" value="{{$editNewsslider_Info->slider_order}}" />
                                    
                                </div>
                                    <div class="col-md-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary float-right">Update</button>
                               </div>
                        
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
</body>
</html>