<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>News</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="{{asset('/assets/images/logo.png')}}">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="{{asset('/assets/images/logo.png')}}">
  
  <!-- style -->
  <link rel="stylesheet" href="{{asset('/assets/animate.css/animate.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/assets/glyphicons/glyphicons.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/assets/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/assets/material-design-icons/material-design-icons.css')}}" type="text/css" />

  <link rel="stylesheet" href="{{asset('/assets/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="{{asset('/assets/styles/app.css')}}" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="{{asset('/assets/styles/font.css')}}" type="text/css" />
</head>
<body class="pace-done">
  <div class="app" id="app">

<!-- ############ LAYOUT START-->

  <!-- aside -->
  <div id="aside" class="app-aside box-shadow-z3 modal fade lg nav-expand">
    <div class="left navside white dk" layout="column">
      <div class="navbar navbar-md info no-radius box-shadow-z4">
        <!-- brand -->
        <a class="navbar-brand">
          <div ui-include="{{asset('/assets/images/logo.white.svg')}}"></div>
          <img src="{{asset('/assets/images/logo.png')}}" alt="." class="hide">
          <span class="hidden-folded inline">Company Portal</span>
        </a>
        <!-- / brand -->
      </div>
      <div flex class="hide-scroll">
        <nav class="scroll">
          <div ui-include="{{asset('/views/blocks/aside.top.4.html')}}"></div>
          
            <ul class="nav" ui-nav>
              <li class="nav-header hidden-folded">
                <small class="text-muted">Main</small>
              </li>
              
              <li>
                <a href="{{url('dashboard')}}" >
                  <span class="nav-icon">
                    <i class="material-icons">&#xe3fc;
                      <span ui-include="{{asset('/assets/images/i_0.svg')}}"></span>
                    </i>
                  </span>
                  <span class="nav-text">Dashboard</span>
                </a>
              </li>
          
              <li>
                <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                
                  <span class="nav-icon">
                    <i class="material-icons">&#xe5c3;
                      <span ui-include="{{asset('/assets/images/i_1.svg')}}"></span>
                    </i>
                  </span>
                  <span class="nav-text">Apps</span>
                </a>
                <ul class="nav-sub">
                  <li>
                   <a href="{{url('viewNewspaper')}}">
                   Newspaper
                   </a>
                  </li>
                  <li>
                    <a href="{{url('viewNewsCategory')}}">
                    News Categories
                    </a>
                  </li>
                  <li>
                     <a href="{{url('viewNews')}}">
                     News
                     </a>
                  </li>
                  <li>
                     <a href="{{url('viewNewsMapping')}}">
                     News Mapping
                     </a>
                  </li>
                  <li>
                     <a href="{{url('viewNewslider')}}">
                     News Slider
                     </a>
                  </li>
                </ul>
              </li>
          

          
            </ul>
        </nav>
      </div>
      <div flex-no-shrink>
        <div ui-include="{{asset('/views/blocks/aside.bottom.0.html')}}"></div>
      </div>
    </div>
  </div>
  <!-- / aside -->
  
  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">
<div id="content" class="app-content box-shadow-z3" role="main">
    <div class="app-header info box-shadow-z4 navbar-md">
      <div class="navbar navbar-toggleable-sm flex-row align-items-center">
          <!-- Open side - Naviation on mobile -->
          <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
            <i class="material-icons"></i>
          </a>
          <!-- / -->
      
          <!-- Page title - Bind to $state's title -->
          <div class="mb-0 h5 no-wrap" ng-bind="$state.current.data.title" id="pageTitle"></div>
      
          <!-- navbar collapse -->
          <div class="collapse navbar-collapse" id="collapse">
            <!-- link and dropdown -->
            <ul class="nav navbar-nav mr-auto">
              <li class="nav-item dropdown">
                <a class="nav-link" href="" data-toggle="dropdown">
                  <i class="fa fa-fw fa-plus text-muted"></i>
                  <span>New</span>
                </a>
                <div ui-include="{{asset('views/blocks/dropdown.new.html')}}"></div>
              </li>
            </ul>
      
            <div ui-include="{{asset('views/blocks/navbar.form.html')}}"></div>
            <!-- / -->
          </div>
          <!-- / navbar collapse -->
      
          <!-- navbar right -->
          <ul class="nav navbar-nav ml-auto flex-row">
           
            <li class="nav-item dropdown">
              <a class="nav-link p-0 clear" href="#" data-toggle="dropdown">
                <span>{{request()->session()->get('user_email')}}</span>
                <span class="avatar w-32">
                 
                   <img src="{{asset('/assets/images/a0.jpg')}}" alt="image" >

                  
                  <i class="on b-white bottom"></i>
                </span>
                 
              </a>

              <div class="dropdown-menu pull-right dropdown-menu-scale ng-scope">
               
               <!--   <a class="dropdown-item" ui-sref="app.page.profile" href=">
                  <i class="material-icons md-24"></i>
                  My Profile
                  </a> 
                  <a class="dropdown-item" ui-sref="app.page.profile" href="">
                       <i class="fa fa-key" aria-hidden="true"></i>
                       Change Password
                  </a> 
                 <div class="dropdown-divider"></div> -->

                 <a class="dropdown-item" ui-sref="access.signin" href="{{url('logout')}}"><span class="nav-icon"><i class="material-icons"></i></span>Logout out</a>
               </div>
            </li>
           
          </ul>
          <!-- / navbar right -->
      </div>
    </div>
   
    


  </div>
  <div class="padding">
  <div class="margin">
    <h5 class="mb-0 _300"></h5>
    <small class="text-muted"></small>
  </div>
  

 
</div>

<!-- ############ PAGE END-->

  <div id="switcher">
    <div class="switcher box-color dark-white text-color" id="sw-theme">
      <a href ui-toggle-class="active" target="#sw-theme" class="box-color dark-white text-color sw-btn">
        <i class="fa fa-gear"></i>
      </a>
      <div class="box-header">
        
        <h2>Theme Switcher</h2>
      </div>
      <div class="box-divider"></div>
      <div class="box-body">
        <p class="hidden-md-down">
          <label class="md-check m-y-xs"  data-target="folded">
            <input type="checkbox">
            <i class="green"></i>
            <span class="hidden-folded">Folded Aside</span>
          </label>
          <label class="md-check m-y-xs" data-target="boxed">
            <input type="checkbox">
            <i class="green"></i>
            <span class="hidden-folded">Boxed Layout</span>
          </label>
          <label class="m-y-xs pointer" ui-fullscreen>
            <span class="fa fa-expand fa-fw m-r-xs"></span>
            <span>Fullscreen Mode</span>
          </label>
        </p>
        <p>Colors:</p>
        <p data-target="themeID">
          <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'primary', accent:'accent', warn:'warn'}">
            <input type="radio" name="color" value="1">
            <i class="primary"></i>
          </label>
          <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'accent', accent:'cyan', warn:'warn'}">
            <input type="radio" name="color" value="2">
            <i class="accent"></i>
          </label>
          <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'warn', accent:'light-blue', warn:'warning'}">
            <input type="radio" name="color" value="3">
            <i class="warn"></i>
          </label>
          <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'success', accent:'teal', warn:'lime'}">
            <input type="radio" name="color" value="4">
            <i class="success"></i>
          </label>
          <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'info', accent:'light-blue', warn:'success'}">
            <input type="radio" name="color" value="5">
            <i class="info"></i>
          </label>
          <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'blue', accent:'indigo', warn:'primary'}">
            <input type="radio" name="color" value="6">
            <i class="blue"></i>
          </label>
          <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'warning', accent:'grey-100', warn:'success'}">
            <input type="radio" name="color" value="7">
            <i class="warning"></i>
          </label>
          <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'danger', accent:'grey-100', warn:'grey-300'}">
            <input type="radio" name="color" value="8">
            <i class="danger"></i>
          </label>
        </p>
        <p>Themes:</p>
        <div data-target="bg" class="row no-gutter text-u-c text-center _600 clearfix">
          <label class="p-a col-sm-6 light pointer m-0">
            <input type="radio" name="theme" value="" hidden>
            Light
          </label>
          <label class="p-a col-sm-6 grey pointer m-0">
            <input type="radio" name="theme" value="grey" hidden>
            Grey
          </label>
          <label class="p-a col-sm-6 dark pointer m-0">
            <input type="radio" name="theme" value="dark" hidden>
            Dark
          </label>
          <label class="p-a col-sm-6 black pointer m-0">
            <input type="radio" name="theme" value="black" hidden>
            Black
          </label>
        </div>
      </div>
    </div>
    
    
  </div>
  <!-- / -->

<!-- ############ LAYOUT END-->
<section class="content" >
  <div class="block-header">
                
                <h2 class="ml-2">Welcome {{request()->session()->get('user_name')}}</h2>
            </div>
        <div class="container col-10" style="position: absolute;">
             @yield('main_content')
         </div>
</section>

  </div>
<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
  <script src="{{asset('/libs/jquery/jquery/dist/jquery.js')}}"></script>
<!-- Bootstrap -->
  <script src="{{asset('/libs/jquery/tether/dist/js/tether.min.js')}}"></script>
  <script src="{{asset('libs/jquery/bootstrap/dist/js/bootstrap.js')}}"></script>
<!-- core -->
  <script src="{{asset('/libs/jquery/underscore/underscore-min.js')}}"></script>
  <script src="{{asset('/libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js')}}"></script>
  <script src="{{asset('libs/jquery/PACE/pace.min.js')}}"></script>

  <script src="{{asset('scripts/config.lazyload.js')}}"></script>

  <script src="{{asset('/scripts/palette.js')}}"></script>
  <script src="{{asset('/scripts/ui-load.js')}}"></script>
  <script src="{{asset('/scripts/ui-jp.js')}}"></script>
  <script src="{{asset('/scripts/ui-include.js')}}"></script>
  <script src="{{asset('/scripts/ui-device.js')}}"></script>
  <script src="{{asset('/scripts/ui-form.js')}}"></script>
  <script src="{{asset('/scripts/ui-nav.js')}}"></script>
  <script src="{{asset('/scripts/ui-screenfull.js')}}"></script>
  <script src="{{asset('/scripts/ui-scroll-to.js')}}"></script>
  <script src="{{asset('/scripts/ui-toggle-class.js')}}"></script>

  <script src="{{asset('/scripts/app.js')}}"></script>

  <!-- ajax -->
  <script src="{{asset('/libs/jquery/jquery-pjax/jquery.pjax.js')}}"></script>
  <script src="{{asset('/scripts/ajax.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<!------------------------------Script for text Editor --------------------------->
<script src="{{asset('/texteditor_plugin/ckeditor.js')}}"></script>
  
<!-- endbuild -->
</body>
</html>
