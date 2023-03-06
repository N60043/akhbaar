<!DOCTYPE html>
<html >
<head>
  <title>Home</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/styles.css')}}"> 
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- CDN for Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--  CDN for jQUERY -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style type="text/css">
    @media screen and (max-width:991px)
    {
     #login_paragraph
     {
         width: 15rem;
     }
     .form
     {
         width: 30rem;
     }


    }
    #responseShow
{
    color: white;
    font-size: 16px;
    background: #a92a40;
    padding: 4px;
    border-radius: 7px;
    display: none;
  }

  </style>
</head>
<body style="background-color: black;color: white;">
  @include('Layouts.header')
  <div class="container-fluid " style="background-image: url('{{ asset('images/loginbg.webp')}}');background-size: cover;height: 100vh;">
    <div class="container" >

      <div class="main-content d-flex " >
        <div class="col-6" >
          <div class="row ml-4" id="login_paragraph">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12  mt-1"  id="responseShow" >
            
           </div>
            <h6 class="mt-2">Login with Mobile Akhbaar</h6>
          </div>
          <form class="form" >
            <!-- @csrf -->
            <div class="row phone_div mt-2 ml-3">
              <div class="col-3 "  style="display:contents;">
               <i class="fa fa-phone ml-4 ml-1" aria-hidden="true"></i>
              </div>
              <div class="col-8" style="padding-top: 0.2rem;color: white;">
              <input class="phone-InputField" type="number" id="phoneNumber" name="phoneNumber" placeholder="0340-XXXXXXX"
               onKeyPress="if(this.value.length==11) return false;" min="0" required>
              </div>
            </div>
            <div class="row mt-3" style="">
               <button class="otp-Button"  id="btn-save" 
               >Get OTP</button>
            </div>
         </form>
          <div class="row mt-2 ml-1" style="">
             <div class="col-1 ml-1">
               <i class="fa-solid fa-check"></i>
             </div>
             <div class="col-12 ml-4 mt-1  position-absolute">
              <p class="subscribing-paragraph" >Subscription charges: Rs. 7 + tax/day</p>
             </div>
          </div>
           <div class="row  ml-1" style="">
             <div class="col-1 ml-1">
               <i class="fa-solid fa-check"></i>
             </div>
             <div class="col-12 ml-4 mt-1  position-absolute">
              <p class="subscribing-paragraph" >By subscribing you are agreeing to daily
              auto renewal charging
              </p>
             </div>
          </div>
          <div class="row mt-3 ml-1" style="">
             <div class="col-1 ml-1">
               <i class="fa-solid fa-check"></i>
             </div>
             <div class="col-12 ml-4 mt-1  position-absolute">
              <p class="subscribing-paragraph">By subscribing you are agreeing to daily
              auto renewal charging
              </p>
             </div>
          </div>
           
        </div>
       
      </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function($){
     $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
    $("#btn-save").click(function (e) {
      e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = {
            phoneNumber: $('#phoneNumber').val()
        };
        var state = $('#btn-save').val();
        var type = "POST";
        // var todo_id = $('#todo_id').val();
        var ajaxurl = '{{ route("insertOTP")}}';
        // var id = ;
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (res) {
              if(res.status == 0){
              window.location.href = '{{ route("otpPage")}}';
             //console.log(res);
              }else if(res.status == 1){
                  const responseDiv = document.getElementById("responseShow");
                responseDiv.style.display="inline-block";
                $('#responseShow').html(res.Error);
              }
             
            },
            error: function (res) {
                console.log(res);
            }
        });
    });
});

</script>
</body>
</html>