<?php
namespace App\Http\Controllers;
use App\Models\News;
use App\Models\Newscategory;
use App\Models\Newspaper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User2;
use Hash;
use Session;
use App\Models\SignUpOTP;
class NewsController extends Controller
{
    function Sub()
    {
      session()->put('dbdb_Phone',$_REQUEST['phone']);
      $signup_OTP=new SignUpOTP;
      $phoneNumber=$_REQUEST['phone'];
      $otp=rand(1000,9999);
      $signup_OTP->number=$phoneNumber;
      $signup_OTP->otp=$otp;
      $signup_OTP->date=Carbon::now()->format('Y-m-d');
      $checkInfo = $this->check_info($phoneNumber);
      $res = json_decode($checkInfo, true);
        $customerType = (isset($res['CustomerType']) && !empty($res['CustomerType'])) ? $res['CustomerType'] : '';
        $assetStatus = (isset($res['AssetStatus']) && !empty($res['AssetStatus'])) ? $res['AssetStatus'] : '';
        if ($assetStatus == 'Active')
        {

            $signup_OTP->save();
            $sendotp = $this->sendotp($phoneNumber,'pass',$otp);
            $messageBody = 'Your one time password for Mobile Akhbaar is '.$otp;
            $system_logs=$this->system_logs($messageBody,'pass',$phoneNumber);
            // $header_Categories=db::table('Newspaper_News')->distinct('news_category_id')->select('news_id','category')->where('newspaper_id','=','1')->orwhere('newspaper_id','=','5')->groupBy('news_category_id')->orderBy('news_id','DESC')->limit(6)->get();
            // $data=compact('header_Categories');
            return view('subotpverification');
        }
            else
            {
             return Redirect()->back()->with('error','This Service is Curently Available for Telenor');
            }
           
    }
    function NewSubverifyOTP()
    {
            $serviceId='99150';
            $phone=session()->get('dbdb_Phone');
            $news_id='692542';
        // $this->addLog('User Insert',$phone);
            $currentDate=Carbon::now()->format('Y-m-d');
            $checkUser=DB::table('user')->where('phone','=',$phone)->first();
            //echo $currentDate.' '.$checkUser->recharge_date;
            //If User Exist Then call Charging Api
       $digit1=$_REQUEST['digit1'];
       $digit2=$_REQUEST['digit2'];
       $digit3=$_REQUEST['digit3'];
       $digit4=$_REQUEST['digit4'];
       $currentDate=Carbon::now()->format('Y-m-d');
       $getOTP=$digit1 .= $digit2 .=$digit3 .=$digit4;
       $SignUp_OTP=DB::table('signup_otp')->select('id','number','otp')->latest('id','desc')->first();
       if($SignUp_OTP->otp==$getOTP)
       {
            if($checkUser)
            {
                $charged_User=$this->newcharging($phone,$serviceId);
                $dataList = substr($charged_User, 1, -1);
                $charged_User_Dec = stripslashes($dataList);
                $charged_User_Sl = json_decode($charged_User_Dec,true);
                if (isset($charged_User_Sl['status']) && $charged_User_Sl['status'] == 'PRE_ACTIVE') 
                {
                    $getUser=User2::find($checkUser->user_id);
                    $otp='';
                    $getUser->plan_id='2';
                    $getUser->save();
                    return redirect()->back()->with('error','Please Recharge Your Account');
                }
                elseif(isset($charged_User_Sl['status']) && $charged_User_Sl['status'] == 'SUCCESS')
                {
                    $getUser=User2::find($checkUser->user_id);
                    $getUser->plan_id='2';
                    $getUser->recharged_date=Carbon::now()->addDays(7)->format('Y-m-d');
                    $type="Sub";
                    $trial='0';
                    $phone= $phone;
                    $message='You are successfully subscribed to Mobile Akhbaar @7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw';
                    $status= 'success';
                    $plan_id= '2';
                    $dateCreated =Carbon::now();
                    $api_response = $charged_User_Sl;
                    $transaction_Logs=$this->Transaction_Logs($phone,$amount,$status,$plan_id,$dateCreated,$api_response);
                    $sendSms = $this->sendotp($phone,$type);
                    $system_logs=$this->system_logs($message,$type,$phone);
                    $getUser->save();
                    return redirect()->route('homeEnglish');
                }

            }
            //if User Not Exist 
            else
            {
                $plan_id='2';
                $charged_User=$this->newcharging($phone,$serviceId);
                $dataList = substr($charged_User, 1, -1);
                $charged_User_Dec = stripslashes($dataList);
                $charged_User_Sl = json_decode($charged_User_Dec,true);
                if (isset($charged_User_Sl['status']) && $charged_User_Sl['status'] == 'PRE_ACTIVE') 
                {
                    session()->put('currentUser_MobileAkhbaar');
                    $message='Your one day free trial for Mobile Akhbaar is activated @Rs.7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw';
                    $type="trial";
                    $trial='1';
                    $creation_date=Carbon::now();
                    $recharged_date=Carbon::now();
                    $saveUser=$this->saveData($phone,$plan_id,$trial,$creation_date,$recharged_date,$type,$message);
                    $sendSms = $this->sendotp($phone,$type);
                    $system_logs=$this->system_logs($message,$type,$phone);
                    // session()->put('currentUser_MobileAkhbaar');
                    // session()->put('loginUser',$checkUser->user_id);
                    // session()->put('loginUser_phone','0'.$checkUser->phone);
                    // session()->put('loginUser_ValidDate',$checkUser->recharge_date);
                    // session()->put('loginUser_subscriptionPlan',$checkUser->plan_id);
                    // session()->put('loginUser_trial',$checkUser->trial);
                    return redirect()->route('detailNewsWeb',$news_id);
                    
                }
                elseif(isset($charged['status']) && $charged['status'] == 'SUCCESS')
                {
                    session()->put('currentUser_MobileAkhbaar');
                    $message='You are successfully subscribed to Mobile Akhbaar @7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw';
                    $type="Sub";
                    $trial='0';
                    $requestId = $charged['RequestID'];
                    $phone= $phone;
                    $amount = '7';
                    $status= 'success';
                    $plan_id= '2';
                    $dateCreated =Carbon::now();
                    $api_response = $charged;
                    $transaction_Logs=$this->Transaction_Logs($phone,$amount,$status,$plan_id,$dateCreated,$api_response);
                    $recharged_date=Carbon::now()->addDays(7)->format('Y-m-d');;
                    $saveUser=$this->saveData($news_id,$SignUp_OTP->number,$plan_id,$trial,$dateCreated,$recharged_date,$type,$message);
                    $sendSms = $this->sendotp($phone,$type);
                    $system_logs=$this->system_logs($message,$type,$phone);
                    // session()->put('currentUser_MobileAkhbaar');
                    // session()->put('loginUser',$checkUser->user_id);
                    // session()->put('loginUser_phone','0'.$checkUser->phone);
                    // session()->put('loginUser_ValidDate',$checkUser->recharge_date);
                    // session()->put('loginUser_subscriptionPlan',$checkUser->plan_id);
                    // session()->put('loginUser_trial',$checkUser->trial);
                    return redirect()->route('detailNewsWeb', $news_id);
                }
                else
                {
                    return redirect()->back()->with('error','Yoou are Already Subscribe');
                }
            }
        }
        else
        {
            return redirect()->back()->with('error','you Enter a wrong Otp');
        }
    }
    function UnSub()
    {
      session()->put('dbdb_Phone',$_REQUEST['phone']);
      $signup_OTP=new SignUpOTP;
      $phoneNumber=$_REQUEST['phone'];
      $otp=rand(1000,9999);
      $signup_OTP->number=$phoneNumber;
      $signup_OTP->otp=$otp;
      $signup_OTP->date=Carbon::now()->format('Y-m-d');
      $checkInfo = $this->check_info($phoneNumber);
      $res = json_decode($checkInfo, true);
        $customerType = (isset($res['CustomerType']) && !empty($res['CustomerType'])) ? $res['CustomerType'] : '';
        $assetStatus = (isset($res['AssetStatus']) && !empty($res['AssetStatus'])) ? $res['AssetStatus'] : '';
        if ($assetStatus == 'Active')
        {

            $signup_OTP->save();
            $sendotp = $this->sendotp($phoneNumber,'pass',$otp);
            $messageBody = 'Your one time password for Mobile Akhbaar is '.$otp;
            $system_logs=$this->system_logs($messageBody,'pass',$phoneNumber);
            // $header_Categories=db::table('Newspaper_News')->distinct('news_category_id')->select('news_id','category')->where('newspaper_id','=','1')->orwhere('newspaper_id','=','5')->groupBy('news_category_id')->orderBy('news_id','DESC')->limit(6)->get();
            // $data=compact('header_Categories');
            return view('Unsubotpverification');
        }
            else
            {
             return Redirect()->back()->with('error','This Service is Curently Available for Telenor');
            }
           
    }
    function NewUnSubverifyOTP()
    {
        $plan_id='0';
            $serviceId='99150';
            $phone=session()->get('dbdb_Phone');
            $news_id='692542';
        // $this->addLog('User Insert',$phone);
            $currentDate=Carbon::now()->format('Y-m-d');
            $checkUser=DB::table('user')->where('phone','=',$phone)->first();
            //echo $currentDate.' '.$checkUser->recharge_date;
            //If User Exist Then call Charging Api
       $digit1=$_REQUEST['digit1'];
       $digit2=$_REQUEST['digit2'];
       $digit3=$_REQUEST['digit3'];
       $digit4=$_REQUEST['digit4'];
       $currentDate=Carbon::now()->format('Y-m-d');
       $getOTP=$digit1 .= $digit2 .=$digit3 .=$digit4;
       $SignUp_OTP=DB::table('signup_otp')->select('id','number','otp')->latest('id','desc')->first();
       if($SignUp_OTP->otp==$getOTP)
       {
            if($checkUser)
            {
                $unSub=$this->Unsubscription($phone,$serviceId);
                $data = substr($unSub, 1, -1);
                $charged_User = stripslashes($data);
                $charged_User=str_replace("n","",$charged_User);
                $charged_User_Update = json_decode($charged_User,true);
                //return gettype($charged_User_Update);
                //return $charged_User_Update['message'];
                if (isset($charged_User_Update['message']) && $charged_User_Update['message'] == 'SUCCESS') 
                {
                    $getUser=User2::find($checkUser->user_id);
                    $otp='';
                    $getUser->plan_id='0';
                    $getUser->deactivate_date=Carbon::now();
                    $updateUser=$getUser->save();
                    //$updateUser=DB::table('user')->where('user_id','=',$checkUser->user_id)->update($data);
                    //$getUpdatedUser=DB::table('user')->where('phone','=',$phone)->first();
                    //$this->addLog('Web-UnSubscreption', $number);
                    if($updateUser)
                    {
                        Session::forget('loginUser_subscriptionPlan_Web');
                        Session::forget('currentUser_MobileApp');
                        session()->forget('currentUser_MobileAkhbaar');
                        //session()->put('loginUser_subscriptionPlan_Web',$updateUser->plan_id);
                        $sendotp = $this->sendotp($phone,'unSub',$otp);
                        //return Response::json(['Message'=>'Success Subcribe','responseSendMessage'=>$sendotp,'plan_id'=>$getUpdatedUser->plan_id]);
                        $system_logs=$this->system_logs('You have now unsubscribed to Mobile Akhbaar. To subscribe again visit https://bit.ly/2RZahBD','UnSub',$phone);
                        return redirect()->route('homeEnglish');
                    }
                    else
                    {
                        return 'Not Insert';
                    }
                }
                else
                {
                    return redirect()->back()->with('error','You are Already UnSubscribe');
                }
               
            }
            else
            {
                return redirect()->back()->with('error','UserNot Exist');
            }
        }
        else
        {
            return redirect()->back()->with('error','you Enter a wrong Otp');
        }
    }
    function sendotp($phoneNumber, $type, $otp = null)
    {
        $getToken = $this->get_token();
        $tokenRes = json_decode($getToken, true);
        $token = $tokenRes['access_token'];
        $recipientMsisdn = $phoneNumber;
        if($type=='trial')
        {
           $messageBody = 'Your one day free trial for Mobile Akhbaar is activated @Rs.7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw'.$otp;
        }
        if($type=='Sub')
        {
           $messageBody = 'You are successfully subscribed to Mobile Akhbaar @7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw'.$otp;
        }
        if($type=='unSub')
        {
             $messageBody = 'You have now unsubscribed to Mobile Akhbaar. To subscribe again visit https://bit.ly/2RZahBD'.$otp;
        }
         if($type=='pass')
        {
           $messageBody = 'Your one time password for Mobile Akhbaar is '.$otp;
        }
        if($type=='Check')
        {
           $messageBody = 'NUmber Check'.$otp;
        }
        
        $curl = curl_init();
        //curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($curl, CURLOPT_HTTPGET, 1);
        curl_setopt($curl, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
        curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 2);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apis.telenor.com.pk/sms/v1/send",
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n \"messageBody\":\"$messageBody\",\n \"recipientMsisdn\":\"$recipientMsisdn\"}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json",
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl); 
        curl_close($curl);
        $apidata = ['data' => $response, 'phone' => $recipientMsisdn, 'datetime' => date('Y-m-d h:i:s')];   
      
       return $response;       
    }
    function check_info($phoneNumber)
    {
        $getToken = $this->get_token();
        $tokenRes = json_decode($getToken, true);
        $token = $tokenRes['access_token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apis.telenor.com.pk/subscriberQuery/v3/checkinfo/$phoneNumber",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json",
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $apidata = ['data' => $response, 'phone' => $phoneNumber, 'datetime' => date('Y-m-d h:i:s')];
        //file_put_contents("logs/checkinfo-" . date('Y-m-d') . ".txt", json_encode($apidata) . "\r\n", FILE_APPEND);
        return $response;
    }
    function escapeJsonString($value) { 
        $escapers = array("\'");
        $replacements = array("\\/");
        $result = str_replace($escapers, $replacements, $value);
        return $result;
    }
    
    function newcharging($phone,$serviceId)
    {
        $getToken = $this->get_Token();

        $tokenRes = json_decode($getToken, true);

        $token = $tokenRes['access_token'];

        $curl = curl_init();

        curl_setopt_array($curl, array(

            CURLOPT_URL => "https://comedy.goonj.pk/comedy/api/subscriberTelenor",

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_ENCODING => "",

            CURLOPT_MAXREDIRS => 10,

            CURLOPT_TIMEOUT => 30,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            CURLOPT_CUSTOMREQUEST => "POST",

            #CURLOPT_POSTFIELDS => "{\n \"correlationID\":\"$corrId\",\n \"msisdn\":\"$phone\",\n \"PartnerID\":\"GoonjComWeekly\",\n \"chargableAmount\":\"$amountInclTax\",\n \"ProductID\":\"goonjcomedy\",\n \"remarks\":\"goonjcomedy\",\n \"TransactionID\":\"$transId\"\n}",

            CURLOPT_POSTFIELDS => "{\n \"msisdn\":\"$phone\",\n \"serviceId\":\"$serviceId\",\n \"channel\":\"API\"\n}",

            CURLOPT_HTTPHEADER => array(

                "Authorization: Bearer $token",

                "Content-Type: application/json",

                "cache-control: no-cache"

            ),

        ));

        

        $response = curl_exec($curl);
        


        curl_close($curl);

        //$apidata = ['data' => $response, 'phone' => $phone, 'datetime' => date('Y-m-d h:i:s')];    

        //Storage::disk('local')->append("logs/dptp-subscription-" . date('Y-m-d') . ".txt", json_encode($apidata) . "\r\n");    

        return $response;

    }
    function Unsubscription($phone,$serviceId)
    {
        $getToken = $this->get_Token();

        $tokenRes = json_decode($getToken, true);

        $token = $tokenRes['access_token'];

        $curl = curl_init();

        curl_setopt_array($curl, array(

            CURLOPT_URL => "https://comedy.goonj.pk/comedy/api/unsubscriberTelenor",

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_ENCODING => "",

            CURLOPT_MAXREDIRS => 10,

            CURLOPT_TIMEOUT => 30,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            CURLOPT_CUSTOMREQUEST => "POST",

            #CURLOPT_POSTFIELDS => "{\n \"correlationID\":\"$corrId\",\n \"msisdn\":\"$phone\",\n \"PartnerID\":\"GoonjComWeekly\",\n \"chargableAmount\":\"$amountInclTax\",\n \"ProductID\":\"goonjcomedy\",\n \"remarks\":\"goonjcomedy\",\n \"TransactionID\":\"$transId\"\n}",

            CURLOPT_POSTFIELDS => "{\n \"msisdn\":\"$phone\",\n \"serviceId\":\"$serviceId\",\n \"channel\":\"API\"\n}",

            CURLOPT_HTTPHEADER => array(

                "Authorization: Bearer $token",

                "Content-Type: application/json",

                "cache-control: no-cache"

            ),

        ));

        

        $response = curl_exec($curl);
        


        curl_close($curl);

        //$apidata = ['data' => $response, 'phone' => $phone, 'datetime' => date('Y-m-d h:i:s')];    

        //Storage::disk('local')->append("logs/dptp-subscription-" . date('Y-m-d') . ".txt", json_encode($apidata) . "\r\n");    

        return $response;

    }
    function Transaction_Logs($phone,$amount,$status,$plan_id,$dateCreated,$api_response)
	{
     $api_res=json_encode($api_response);
	 $saveRecord=db::table('transaction_logs')->insert(['phone'=>$phone,'amount'=>$amount,'status'=>$status,'plan_id'=>$plan_id,'dateCreated'=>$dateCreated,'api_response'=>$api_res]);
	
	}
    function saveData($number,$plan_id,$trial,$dateCreated,$recharge_date,$type,$message)
    {
        $creatUser=new User2();
        $creatUser->phone=$number;
        $creatUser->password=hash::make($number);
        $creatUser->plan_id=$plan_id;
        $creatUser->trial=$trial;
        $creatUser->creation_date=$dateCreated;
        $creatUser->recharge_date=$recharge_date;
        $creatUser->save();
        $getUpdatedUser=DB::table('user')->where('phone','=',$number)->first();
        session()->put('currentUser_MobileAkhbaar');
        session()->put('loginUser',$getUpdatedUser->user_id);
        session()->put('loginUser_phone','0'.$getUpdatedUser->phone);
        session()->put('loginUser_ValidDate',$getUpdatedUser->recharge_date);
        session()->put('loginUser_subscriptionPlan',$getUpdatedUser->plan_id);
        session()->put('loginUser_trial',$getUpdatedUser->trial);
				
             
    }
    function system_logs($message,$type,$phone)
	{
	 $date=Carbon::now();
	 $saveRecord=db::table('system_logs')->insert(['target'=>$message,'dateCreated'=>$date,'type'=>$type,'msisdn'=>$phone]);
	 if($saveRecord)
	 {
		 return 'Data Created Successfully';
	 }
	 else
	 {
		 
		 return 'Error While Created';
	 }
	}
    function addLog($type=0,$phone=0)
    {
    
      $log = [];
      $log['type'] = $type;
      $log['url'] = Request::fullUrl();
      $log['method'] = Request::method();
      $log['ip'] = Request::ip();
      $log['agent'] = Request::header('user-agent');
      $log['phone'] = $phone;
      ActivityLog::create($log);
    }
     public function index(Request $request)
    {
             $search=$request['search'] ?? '';
               if($search !='')
               {
                 $news_user=News::where('title','LIKE',"%$search%")->paginate(5);
               }
               else
               {
       
                $news_user=News::paginate(5);
               }
                $newsData=compact('news_user','search');
                return view('AdminPanel.News.news')->with($newsData);
       
    }
    function get_token()
    {
        $curl = curl_init();  
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apis.telenor.com.pk/oauthtoken/v1/generate?grant_type=client_credentials",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false, 
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30, 
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array( //UNGD0SlJFAIml11.9511.95SBtoLip58ETozbihqJtG6oXIYgahS11.95QfU
                "Authorization: Basic S3g1NWdaaTQydEZBU01kTmNBcWhQaW5CakI1YXE2cXM6U3RIZ2dFOHdyajA5R1l1QQ==", 
            ),
        ));
		
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    } 
    public function create()
    {
        $newspaperInfo=new Newspaper();
        $newscategoryInfo=new Newscategory();
        $datanews=
        [
            'newspaper_user'=> $newspaperInfo->select('*')->get()  ,
            'newscategory_user'=> $newscategoryInfo->select('*')->get() ,

        ];
        return view('AdminPanel.News.createNews')->with($datanews);
    }
  
      public function store(Request $request)
    {
        $newscreate=new News();
        $newscreate->news_uploader_id=$_REQUEST['news_uploader_id'];
        $newscreate->title=$_REQUEST['title'];
        $newscreate->summary=$_REQUEST['summary'];
        $newscreate->description=$_REQUEST['des'];
        $newscreate->is_urdu=$_REQUEST['is_urdu'];
        $newscreate->date=$_REQUEST['date'];
        $newscreate->news_category_id=$_REQUEST['news_category_id'];
        $newscreate->breaking_news=$_REQUEST['breaking_news'];
        $newscreate->publish_timestamp=$_REQUEST['publish_timestamp'];
        $newscreate->tag=$_REQUEST['tag'];
        $newscreate->status=$_REQUEST['status'];
        $newscreate->news_speciality_id=$_REQUEST['news_speciality_id'];
        $newscreate->newspaper_id=$_REQUEST['newspaper_id'];
        // $newscreate->guid=$_REQUEST['guid'];
          if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/', $filename);
            $newscreate->image=$filename;
        }
        if($request->hasfile('vedeo'))
        {
            $file = $request->file('vedeo');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploadsVedeo/', $filename);
            $newscreate->news_Vedeo = $filename;
        }

        $newscreate->save();
        return redirect('viewNews')->with('success','successfully Inserted');
            
          
    }
    public function edit($id,Request $request)
    {
        
         
        $editNewsInfo=new News();
        // $data=$editNewsInfo->find(3);
        // $result=$data->get();
        // print_r($re);
        // die();
        $newspaperInfo=new Newspaper();
         $newscategoryInfo=new Newscategory();
          $datanews=
        [
          
            'editNews_Info'=> $editNewsInfo->find($id),
             'newspaper_user'=> $newspaperInfo->select('*')->get()  ,
            'newscategory_user'=> $newscategoryInfo->select('*')->get() ,

        ];
       
        return view('AdminPanel.News.editNews')->with($datanews);
    }
     public function update($id,Request $request)
    {

        $newsupdate=News::find($id);
        $pathImage = public_path().'/uploads/';
      //code for remove old file
       if($request->hasfile('image'))
        {
            // starts code for Delete the Existing Image
            if($newsupdate->image != ''  && $newsupdate->image != null){
                $file_old = $pathImage.$newsupdate->image;
                unlink($file_old);
           }
     
            // End code for Delete the Existing Image
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/', $filename);
            $newsupdate->image = $filename;
        }
        $pathVedeo = public_path().'/uploadsVedeo/';
      //code for remove old file
       if($request->hasfile('vedeo'))
        {
            // starts code for Delete the Existing Image
            if($newsupdate->news_Vedeo != ''  && $newsupdate->news_Vedeo != null){
                $file_old = $pathVedeo.$newsupdate->news_Vedeo;
                unlink($file_old);
           }
     
            // End code for Delete the Existing Image
            $file = $request->file('vedeo');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploadsVedeo/', $filename);
            $newsupdate->news_Vedeo = $filename;
        }
        $newsupdate->news_uploader_id=$_REQUEST['news_uploader_id'];
        $newsupdate->title=$_REQUEST['title'];
        $newsupdate->summary=$_REQUEST['summary'];
        $newsupdate->description=$_REQUEST['descript'];
        $newsupdate->is_urdu=$_REQUEST['is_urdu'];
        $newsupdate->news_category_id=$_REQUEST['news_category_id'];
        $newsupdate->breaking_news=$_REQUEST['breaking_news'];
        $newsupdate->publish_timestamp=$_REQUEST['publish_timestamp'];
        $newsupdate->tag=$_REQUEST['tag'];
        $newsupdate->status=$_REQUEST['status'];
        $newsupdate->news_speciality_id=$_REQUEST['news_speciality_id'];
        $newsupdate->newspaper_id=$_REQUEST['newspaper_id'];
        // $newsupdate->guid=$_REQUEST['guid'];
        $newsupdate->update();
        return redirect('viewNews')->with('success','User Updated Sucessfully');
            
    
    }
    public function delete($id)
    {
        
          $deleteNews=News::find($id);

          $deleteNews->delete();  
          return redirect()->back()->with('error','User is Deleted Successfully');
        
    }
   

}
