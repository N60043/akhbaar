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
       
                    <form method="POST" action="{{url('storenews')}}" class="creatnews-form"  id="createnews-form" enctype="multipart/form-data">
                    @csrf
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                 <label>News Uploader Id:</label>
                                  <input autocomplete="off" type="number" class="form-control" name="news_uploader_id" title="Only Integer Value is Allowed" value="{{old('news_uploader_id')}}" required />
                                </div>
                                 
                            </div>
                                
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                 <label>Title:</label>
                                  <input autocomplete="off" type="text" class="form-control"  name="title" value="{{old('title')}}"  required />
                                </div>
                                
                            </div>
                             <div class="col-md-12">
                                <div class="form-group mb-2">
                                     <label>Summary:</label>
                                     <textarea class="form-control ng-pristine ng-valid ng-not-empty ng-touched" name="summary"  rows="3" value="{{old('summary')}}" required></textarea>
                                </div>
                                
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group mb-2">
                                 <label>Description:</label>
                                 <textarea class="form-control ng-pristine ng-valid ng-not-empty ng-touched "  name="des" value={{old('des')}} required="true"></textarea>
                                </div>
                               
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Is Urdu:</label>
                                    <select class="form-control input-c" id="inlineFormSelectPref" name="is_urdu" value="{{old('is_urdu')}}" required="true">
                                          <option value="">Choose One</option>
                                          <option value="1">Urdu</option>
                                          <option value="0">English</option>
                                          <!-- <option value="1">Trending News</option>
                                          <option value="2">News of the Day</option>
                                          <option value="1">Trending News</option>
                                          <option value="2">News of the Day</option> -->
                                   </select>
                                    
                                </div>
                                 
                             <div class="col-md-12" >
                               <div class="form-outline mb-4">
                                 <label class="form-label" for="form3Example1q">Image:</label>
                                <input type="file" id="form3Example1q" class="form-control" name="image" accept="image/*"  value="{{old('image')}}" required/>
                                
                               </div>
                                
                           </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Upload vedeo:</label>
                                        <input type="file" id="form3Example1q" class="form-control" name="vedeo" accept="video/*"  required /> 
                                </div>
                                 
                            </div>
                               <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Tag:</label>
                                    <input autocomplete="off" type="text" class="form-control"  name="tag" value="{{old('tag')}}" required />
                                    
                                </div>
                              
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>status:</label>
                                    <input autocomplete="off" type="text" class="form-control"  name="status" value="{{old('status')}}" required />
                                    
                                </div>
                              
                            </div>
                            <!--  <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>guid:</label>
                                    <input autocomplete="off" type="text" class="form-control"  name="guid" value="{{old('guid')}}" required />
                                    
                                </div>
                              
                            </div> -->
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Date:</label>
                                    <input autocomplete="off" type="date" class="form-control" placeholder="" name="date" value="{{old('date')}}" required />
                                    
                                </div>
                                  
                            </div>
                          
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>News Category Id:</label>
                                   
                                     <select class="form-control input-c" id="inlineFormSelectPref" name="news_category_id" value="{{old('news_category_id')}}" required="true">
			                              <option value="">Choose One</option>
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
                                    <label>News Paper Id:</label>
                                   
                                     <select class="form-control input-c" id="inlineFormSelectPref" name="newspaper_id" value="{{old('newspaper_id')}}" required="true">
			                              <option value="">Chose One</option>
			                      
                                          @foreach($newspaper_user as $data)
                                           <option value="<?= $data['id']?>">
                                            <?= $data['id'].".".$data['name']?>
                                          @endforeach

			                             
			                              
			                       </select>
                                </div>
                                 
                            </div>
                           
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>News Speciality Id:</label>
                                    <select class="form-control input-c" id="inlineFormSelectPref" name="news_speciality_id" value="{{old('news_speciality_id')}}" required="true">
			                              <option value="">Choose One</option>
			                              <option value="0">None</option>
			                              <option value="1">Trending News</option>
                                          <option value="2">News of the Day</option>
                                          <option value="3">National</option>
                                          <option value="4">Top Stories</option>
                                          <!-- <option value="1">Trending News</option>
                                          <option value="2">News of the Day</option>
                                          <option value="1">Trending News</option>
                                          <option value="2">News of the Day</option> -->
			                       </select>
                                    
                                </div>
                                 
                            </div>
                           
                             <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Breaking News:</label>
                                    <select class="form-control input-c" id="inlineFormSelectPref" name="breaking_news" value="{{old('breaking_news')}}" required>
                                        <option value="">Chose One</option>
                                        <option value="no">In_Active</option>
                                        <option value="active">Active</option>
                                          
                                   </select>
                                </div>

                            </div>
                         
                          <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label>Publish Timestamp:</label>
                                    <select class="form-control input-c" id="inlineFormSelectPref" name="publish_timestamp" value="{{old('publish_timestamp')}}" required>
                                        <option value="">Chose One</option>
                                        <option value="0">Un_Publish</option>
                                        <option value="1">publish</option>
                                          
                                   </select>
                                </div>
                            </div>
                              
                            
                            <div class="col-md-12">
                                <hr>
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                                
                            </div>
                        </div>
                    </form>
                        
                </div>
</div>
<!------------------------------Script for text Editor --------------------------->
<script src="{{asset('texteditor_plugin/ckeditor.js')}}"></script>
<script>
  CKEDITOR.replace('des');
</script>
@endsection
</body>
</html>