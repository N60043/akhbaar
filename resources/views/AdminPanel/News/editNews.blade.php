@extends('AdminPanel.dashboard.admin_dashboard')
<html>
<head>
<title>Create News</title>

</head>
<body>
@section('main_content') 
@csrf 
<div class="card">
    <div class="card-body " style="width: 100%">
       
                  <div class="card">
                    <div class="card-header">
                        <h5>Edit News
                              <a href="{{url('viewNews')}}" class="btn btn-danger btn-sm float-right">Close</a>
                        </h5>
                        
                    </div>
                 <div class="card-body "style="width: 100%">
                     <form method="POST" action="{{url('updateNews/')}}/{{$editNews_Info->news_id}}" class="editnews-form" id="editnews-form" enctype="multipart/form-data">
                       <input type="hidden" name="_method" value="PUT" />
                             @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                 <label>News Uploader Id:</label>
                                  <input autocomplete="off" type="text" class="form-control" name="news_uploader_id" value="{{$editNews_Info->news_uploader_id}}" />
                                </div>
                            </div>
                                
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                 <label>Title:</label>
                                  <input autocomplete="off" type="text" class="form-control"  name="title" value="{{$editNews_Info->title}}" />
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group mb-2">
                                 <label>Summary:</label>
                                  <textarea class="form-control ng-pristine ng-valid ng-not-empty ng-touched" name="summary" ng-model="popover.content" >{{$editNews_Info->summary}}</textarea>
                                </div>
                            </div>
                             <div class="col-md-12" >
                                <div class="form-group mb-2">
                                 <label>Description:</label>
                                 <textarea class="form-control ng-pristine ng-valid ng-not-empty ng-touched" name="descript" ng-model="popover.content" >{{$editNews_Info->description}}</textarea>
                                </div>
                               
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Is Urdu:</label>
                                    <select class="form-control input-c" id="inlineFormSelectPref" name="is_urdu" >
                                        <option selected>{{$editNews_Info->is_urdu}}</option>
                                          <option value="0">Urdu</option>
                                          <option value="1">English</option>
                                          <!-- <option value="1">Trending News</option>
                                          <option value="2">News of the Day</option>
                                          <option value="1">Trending News</option>
                                          <option value="2">News of the Day</option> -->
                                   </select>
                                    
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group mb-2" >
                                    <label>Image:</label>
                                    <input autocomplete="off" type="file" class="form-control" placeholder="" name="image" accept="image/*" >
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2" >
                                    <label>Vedeo:</label>
                                    <input type="file" id="form3Example1q" class="form-control" name="vedeo" accept="video/*"  /> 
                                </div>
                            </div>
                           
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Tag:</label>
                                    <input autocomplete="off" type="text" class="form-control"  name="tag"  value="{{$editNews_Info->tag}}" />
                                    
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>status:</label>
                                    <input autocomplete="off" type="text" class="form-control"  name="status" value="{{$editNews_Info->status}}" required />
                                    
                                </div>
                              
                            </div>
                            <!--  <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>guid:</label>
                                    <input autocomplete="off" type="text" class="form-control"  name="guid" value="{{$editNews_Info->guid}}" required />
                                    
                                </div>
                              
                            </div> -->
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>News Category:</label>
                                   
                                     <select class="form-control input-c" id="inlineFormSelectPref" name="news_category_id" >
                                          <option selected >{{$editNews_Info->news_category_id}}</option>
                                             @foreach($newscategory_user as $data)
                                            
                                          <option value="<?= $data['categoryid']?>">
                                            <?= $data['categoryid'].".".$data['name'] ?>
                                                
                                            </option>
                                            @endforeach
                                          
                                   </select>
                                </div>
                                 
                            </div>
                             <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>News Paper:</label>
                                   
                                     <select class="form-control input-c" id="inlineFormSelectPref" name="newspaper_id">
                                           <option selected >{{$editNews_Info->newspaper_id}}</option>
                                           @foreach($newspaper_user as $data)
                                          <option value="<?= $data['newspaper_id']?>">
                                            <?= $data['newspaper_id'].".".$data['name']?>
                                                
                                            </option>
                                           @endforeach
                                   </select>
                                </div>
                                 
                            </div>
                        
                           
                           <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>News Speciality Id:</label>
                                    <select class="form-control input-c" id="inlineFormSelectPref" name="news_speciality_id" >
                                        <option selected >{{$editNews_Info->news_speciality_id}}</option>
                                        <option value="0">None</option>
                                        <option value="1">Trending News</option>
                                        <option value="2">News of the Day</option>
                                        <option value="3">National</option>
                                        <option value="4">Top Stories</option>
                                          
                                   </select>
                                    
                                </div>
                                 
                            </div>
                           
                             <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Breaking News:</label>
                                    <select class="form-control input-c" id="inlineFormSelectPref" name="breaking_news" >
                                        <option selected >{{$editNews_Info->breaking_news}}</option>
                                        <option value="no">In_Active</option>
                                        <option value="active">Active</option>
                                   </select>
                                </div>

                            </div>
                         
                          <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Publish Timestamps:</label>
                                    <select class="form-control input-c" id="inlineFormSelectPref" name="publish_timestamp">
                                        <option selected >{{$editNews_Info->publish_timestamp}}</option>
                                        <option value="0">Un_Publish</option>
                                        <option value="1">publish</option>
                                          
                                   </select>
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