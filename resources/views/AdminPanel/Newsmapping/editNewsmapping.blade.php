
<html>
  <head>
    <title>News Mapping</title>


  </head>
<body>
@extends('AdminPanel.dashboard.admin_dashboard')
@section('main_content') 
<div class="card">
    <div class="card-body " style="width: 100%">
                        <h5>Edit News Mapping
                              <a href="" class="btn btn-danger btn-sm float-right" >Close</a>
                        </h5>
                        
                    </div>
                 <div class="card-body" style="width: 100%">
                    <form method="POST" action="{{url('updateNewsmapping/')}}/{{$editnewsmapping->id}}" class="editnewsmapping-form" id="editnewsmapping-form" >
                     <input type="hidden" name="_method" value="PUT" />
                      @csrf
                             <div class="form-group mb-2">
                                        <label>NewsPaper Id:</label>
                                       
                                         <select class="form-control input-c" id="inlineFormSelectPref" name="newspaper_id" >
                                        <option  selected >{{$editnewsmapping->newspaper_id}}</option>
                                      
                                               @foreach($newspaper_user as $data)
                                              
                                              <option value="{{$data->newspaper_id}}">
                                                <?= $data->newspaper_id.". ".$data->name ?>
                                                
                                              </option>
                                               @endforeach
                                        </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Newspaper Category Name:</label>
                                   
                                     <select class="form-control input-c" id="inlineFormSelectPref" name="newspaper_cat_name" >
                                    <option selected >{{$editnewsmapping->newspaper_cat_name}}</option>
                                   
                                      @foreach($newscategory_user as $data)
                                        
                                          <option value="{{$data->name}}">
                                              {{$data->name}}
                                             
                                            </option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group mb-2">
                                        <label>News Category Id:</label>
                                       
                                         <select class="form-control input-c" id="inlineFormSelectPref" name="news_category_id" >
                                     
                                           <option selected >{{$editnewsmapping->news_category_id}}</option>
                                           @foreach($newscategory_user as $data)
                                               
                                              <option value="{{$data->categoryid}}">
                                                  <?= $data->categoryid.". ".$data->name ?>
                                                 
                                                </option>
                                            @endforeach
                                              
                                      </select>
                                </div>
                                
                            <div class="form-group mb-2">
                             <label class="form-label" for="form3Example1q" >Category URL:</label>
                            <input type="text" id="form3Example1q" class="form-control" name="category_url" value="{{$editnewsmapping->category_url}}"/> 
                           </div>
                          <br/>
                          <button type="submit" class="btn btn-primary float-right" style="">Update</button>

                   </form>

          
        </div>
        </div>
      </div>
    

@endsection
</body>
</html>