
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
       

             <form method="POST" action="{{url('storenewsmapping')}}" id="createnews-form" class="px-md-2" >
                @csrf
                            <div class="form-group mb-2">
                                    <label>NewsPaper Id:</label>
                                   
                                     <select class="form-control input-c" id="inlineFormSelectPref" name="newspaper_id" required="true">
                                    <option value="">Chose One</option>
                                  
                                          @foreach($newspaper_user as $data)
                                          
                                          <option value="{{$data->newspaper_id}}">
                                            <?= $data->newspaper_id.". ".$data->name ?>
                                            
                                          </option>
                                           @endforeach

                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Newspaper Category Name:</label>
                                   
                                     <select class="form-control input-c" id="inlineFormSelectPref" name="newspaper_cat_name" required="true">
                                    <option value="">Choose One</option>
                                   
                                    
                                       @foreach($newscategory_user as $data)
                                           
                                          <option value="{{$data->name}}">
                                              {{$data->name}}
                                             
                                            </option>
                                        @endforeach
                                          
                                  </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label>News Category Id:</label>
                                   
                                     <select class="form-control input-c" id="inlineFormSelectPref" name="news_category_id" required="true">
                                    <option value="">Choose One</option>
                                   
                                    
                                       @foreach($newscategory_user as $data)
                                           
                                          <option value="{{$data->categoryid}}">
                                              <?= $data->categoryid.". ".$data->name ?>
                                             
                                            </option>
                                        @endforeach
                                          
                                  </select>
                                </div>
                               
                                 
                        <div class="form-group mb-2">
                         <label class="form-label" for="form3Example1q" >Category URL:</label>
                        <input type="url" id="form3Example1q" class="form-control" name="category_url"  required /> 
                       </div>
                     <br/>
                      <button type="submit" class="btn btn-primary float-right" style="">Save</button>

               </form>

          
        </div>
        </div>
@endsection