<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\User2;
use App\Models\News;
use App\Models\SignUpOTP;
use Illuminate\Support\Facades\DB;
use Request;
use Carbon\Carbon;
use Hash;
use Session;
use Response;
use App\Models\ActivityLog;
use App\Traits\NewsTrait;

class Auth extends Controller 
{
    function checkConnection()
    {
        return view('DB.db_Connections');
    }
    function login()
    {
        return view('AdminPanel.Auth.login');
    }
    function register()
    {
        return view('AdminPanel.Auth.registration');
    }
    function store(Request $request)
    {
           
       $request->validate([
             'name'=>'required',
             'email'=>'required|email|unique:users',
             'password'=>'required'
        ]);
        $user=new User;
        $user->name=$_REQUEST['name'];
        $user->email=$_REQUEST['email'];
        $user->password=Hash::make($_REQUEST['password']);
        $user->save();
        return redirect('/adminLogin')->with('success','User Inserted Successfully');
    }
    function loginCheck(Request $request)
    {
        $email=$request->email;
        $password=$request->password;
        $user=DB::table('users')->where('email','=',$email)->first();
        if($user)
        {
            if(Hash::check($password,$user->password))
            {
                session()->put('user_id',$user->id);
                session()->put('user_name',$user->name);
                session()->put('user_email',$user->email);
                return redirect('/dashboard');
            }
            else
                return redirect()->back()->with('error','Password is Incorrect');
           
        }
        else
        {
            return redirect()->back()->with('error','Email is not register Please enter a Correct Email');
        }
    }
    function view(Request $request)
    {
          return view('AdminPanel.dashboard.admin_dashboard');
    }
    function logout(Request $request)
    {
       session()->flush();
        $this->addLog('Weblogout');
        return redirect('/adminLogin')->with('success','Successfully Logout');
    }
    // **************************************************************User Login OTP*************************************************
    function userLogin($id)
    {
        session()->put('news_id',$id);
        if(session()->has('English'))
        {
            $header_Categories=db::table('news_category')->select('news_category_id','name','sort_by')
            ->where('sort_by','<','13')->orderBy('sort_by')->get();
        }
        else
        {
            $header_Categories=db::table('news_category')->select('news_category_id','urdu_name','sort_by')
            ->where('sort_by','<','13')->orderBy('sort_by')->get();
        }
        //   $getCurrent_User =News::where('news_id',$id)->with('getNewsCategory')->firstOrFail();
        //   $user=compact('getCurrent_User');
        //$this->addLog('WebloginPage');
        $data = compact('header_Categories');
        return view('News_Frontend_pages.UserLogin.signIn')->with($data);
    } 
    function otp()
    {
        if(session()->has('English'))
        {
            $header_Categories=db::table('news_category')->select('news_category_id','name','sort_by')
            ->where('sort_by','<','13')->orderBy('sort_by')->get();
        }
        else
        {
            $header_Categories=db::table('news_category')->select('news_category_id','urdu_name','sort_by')
            ->where('sort_by','<','13')->orderBy('sort_by')->get();
        }
        $data = compact('header_Categories');
        //$getCurrent_User =News::where('news_id',$id)->with('getNewsCategory')->firstOrFail();
        //$user=compact('id');
        //$this->addLog('WebOTPpage');
        return view('News_Frontend_pages.UserLogin.otpVerification')->with($data);
    }
    function insertOTP(Request $request)
    {
      $signup_OTP=new SignUpOTP;
      $phoneNumber=$_REQUEST['phoneNumber'];
      $otp=rand(1000,9999);
      $signup_OTP->number=$phoneNumber;
      $signup_OTP->otp=$otp;
      $signup_OTP->date=Carbon::now()->format('Y-m-d');
      $checkInfo = $this->check_info($phoneNumber);
      $res = json_decode($checkInfo, true);
      $this->addLog('insertOTP',$phoneNumber);
        $customerType = (isset($res['CustomerType']) && !empty($res['CustomerType'])) ? $res['CustomerType'] : '';
        $assetStatus = (isset($res['AssetStatus']) && !empty($res['AssetStatus'])) ? $res['AssetStatus'] : '';
        if ($assetStatus == 'Active')
        {

            $signup_OTP->save();
            $sendotp = $this->sendotp($phoneNumber,'pass',$otp);
            $messageBody = 'Your one time password for Mobile Akhbaar is '.$otp;
            $system_logs=$this->system_logs($messageBody,'pass',$phoneNumber);
             return ['status'=>0,'data'=> json_decode($sendotp,true) ];
        }
            else
            {
            return Response::json(['status'=>1,'Error'=>'Sorry!This Service is Currently Available for Telenor Users.']);
            }

    } 
    function otpPage()
    {
        if(session()->has('English'))
        {
            $header_Categories=db::table('news_category')->select('news_category_id','name','sort_by')
            ->where('sort_by','<','13')->orderBy('sort_by')->get();
        }
        else
        {
            $header_Categories=db::table('news_category')->select('news_category_id','urdu_name','sort_by')
            ->where('sort_by','<','13')->orderBy('sort_by')->get();
        }
        $data = compact('header_Categories');
        //$getCurrent_User =News::where('news_id',$id)->with('getNewsCategory')->firstOrFail();
        //$user=compact('id');
        //$this->addLog('WebOTPpage');
        return view('News_Frontend_pages.UserLogin.otpVerification')->with($data);
    }
    function verifyOTP()
    {
       $digit1=$_REQUEST['digit1'];
       $digit2=$_REQUEST['digit2'];
       $digit3=$_REQUEST['digit3'];
       $digit4=$_REQUEST['digit4'];
       $currentDate=Carbon::now()->format('Y-m-d');
       $getOTP=$digit1 .= $digit2 .=$digit3 .=$digit4;
       $SignUp_OTP=DB::table('signup_otp')->select('id','number','otp')->latest('id','desc')->first();
       if($SignUp_OTP->otp==$getOTP)
       {
           $this->addLog('verifyOTP',$SignUp_OTP->number);
           $checkUser=DB::table('user')->where('phone','=',$SignUp_OTP->number)->first();
           //If User Exist Then call Charging Api
           if($checkUser)
           {
               if($checkUser->recharge_date<$currentDate)
               {
                    $data['plan_id'] = '0';
                    $updateUser=DB::table('user')->where('phone','=',$SignUp_OTP->number)->update($data);
                    $getUpdatedUser=DB::table('user')->where('phone','=',$SignUp_OTP->number)->first();
                    if($getUpdatedUser)
                    {
                        session()->put('loginUser_Web',$getUpdatedUser->user_id);
                        session()->put('loginUser_phone_Web','0'.$getUpdatedUser->phone);
                        session()->put('loginUser_subscriptionPlan_Web',$checkUser->plan_id);
                        return redirect()->route('subscriptionPlan');
                    }
                    else
                    {
                        return redirect()->back()->with('error','Error While Update your Subscreption Plan');
                    }
                //  session()->put('loginUser_phone_Web','0'.$checkUser->phone);
                //  session()->put('currentUser_MobileAkhbaar','WebLoginUser');
                //  return redirect()->route('subscriptionPlan');
                    
               }
               else
               {
                    session()->put('currentUser_MobileAkhbaar','WebLoginUser');
                    session()->put('loginUser_Web',$checkUser->user_id);
                    session()->put('loginUser_phone_Web','0'.$checkUser->phone);
                    session()->put('loginUser_ValidDate_Web',$checkUser->recharge_date);
                    session()->put('loginUser_subscriptionPlan_Web',$checkUser->plan_id);
                     session()->put('loginUser_trial_Web',$checkUser->trial);
                    return redirect()->route('detailNewsWeb', session()->get('news_id'));
               }
            }
            //if User Not Exist 
           else
           {
                $plan_id='2';
                $charged_User=$this->charging($SignUp_OTP->number,7);
                $charged=json_decode($charged_User,true);
                if (isset($charged['errorCode']) && $charged['errorCode'] == '500.007.05')
                {
                     session()->put('currentUser_MobileAkhbaar','WebLoginUser');
                    $message='Your one day free trial for Mobile Akhbaar is activated @Rs.7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw';
                    $type="trial";
                    $trial='1';
                    $creation_date=Carbon::now();
                    $recharged_date=Carbon::now();
                    $saveUser=$this->saveData($SignUp_OTP->number,$plan_id,$trial,$creation_date,$recharged_date,$type,$message);
                    $sendSms = $this->sendotp($SignUp_OTP->number,$type);
                    $system_logs=$this->system_logs($message,$type,$SignUp_OTP->number);
                    return redirect()->route('detailNewsWeb', session()->get('news_id'));
                    
                }
                elseif (isset($charged['Message']) && $charged['Message'] == 'Success')
                {
                    session()->put('currentUser_MobileAkhbaar','WebLoginUser');
                    $message='You are successfully subscribed to Mobile Akhbaar @7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw';
                    $type="Sub";
                    $trial='0';
                    $requestId = $charged['RequestID'];
                    $phone= $SignUp_OTP->number;
                    $amount = '7';
                    $status= 'success';
                    $plan_id= '2';
                    $dateCreated =Carbon::now();
                    $api_response = $charged;
                    $transaction_Logs=$this->Transaction_Logs($requestId,$phone,$amount,$status,$plan_id,$dateCreated,$api_response);
                    $recharged_date=Carbon::now()->addDays(7)->format('Y-m-d');;
                    $saveUser=$this->saveData($SignUp_OTP->number,$plan_id,$trial,$dateCreated,$recharged_date,$type,$message);
                    $sendSms = $this->sendotp($phone,$type);
                    $system_logs=$this->system_logs($message,$type,$phone);
                    return redirect()->route('detailNewsWeb',session()->get('news_id'));
                    
                }
           }
              
        }
       else
       {
        $this->addLog('OPT Verifing Error',$SignUp_OTP->number);
        return redirect()->back()->with('error','You Enter a Wrong OTP');
       }
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
            session()->put('currentWebUSer',$getUpdatedUser->user_id);
            session()->put('loginUser_phone_Web','0'.$getUpdatedUser->phone);
            session()->put('loginUser_ValidDate_Web',$getUpdatedUser->recharge_date);
            session()->put('loginUser_subscriptionPlan_Web',$getUpdatedUser->plan_id);
            session()->put('loginUser_trial_Web',$getUpdatedUser->trial);
            
        
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
    function charging($phone,$amount)
    {
        $getToken = $this->get_token();
        $tokenRes = json_decode($getToken, true);
        $token = $tokenRes['access_token'];
        $transId = rand ( 1000 , 9999 );
        $corrId = rand ( 1000 , 9999 );
        //$amountInclTax = $amount + ($amount * 0.195);
        $amountInclTax = $amount;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apis.telenor.com.pk/payment/v1/charge",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n \"correlationID\":\"$corrId\",\n \"msisdn\":\"$phone\",\n \"PartnerID\":\"mobileakhbaar_weekly\",\n \"chargableAmount\":\"$amountInclTax\",\n \"ProductID\":\"mobileakhbaar_weekly\",\n \"remarks\":\"mobileakhbaar_weekly\",\n \"TransactionID\":\"$transId\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json",
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $apidata = ['data' => $response, 'phone' => $phone, 'datetime' => date('Y-m-d h:i:s')];
        // file_put_contents("logs/subscription-" . date('Y-m-d') . ".txt", json_encode($apidata) . "\r\n", FILE_APPEND);
        return $response;
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
    function Transaction_Logs($requestId,$phone,$amount,$status,$plan_id,$dateCreated,$api_response)
    {
     $api_res=json_encode($api_response);
     $saveRecord=db::table('transaction_logs')->insert(['transaction_id'=>$requestId,'phone'=>$phone,'amount'=>$amount,'status'=>$status,'plan_id'=>$plan_id,'dateCreated'=>$dateCreated,'api_response'=>$api_res]);
    
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
   ///////////////////////////////////////////////// Profile And Subscription Plan //////////////////////////////////////////////////////// 
    function viewProfile()
    {
        $this->addLog('Web-UserProfile',session()->get('loginUser_phone_Web'));
        return view('News_Frontend_pages.viewProfile');
    }
    function plan_Subscription()
    {
       $this->addLog('Web-planAndSubcription-Page',session()->get('loginUser_phone_Web'));
        $currentWebUSer=session()->get('loginUser_Web');
        $data=compact('currentWebUSer');
        return view('News_Frontend_pages.planandSubscription')->with($data);
    }
    function un_Subscribe($userId)
    {
        $number=session()->get('loginUser_phone_Web');
        $otp='';
        $data['plan_id'] = '0';
        $data['deactivate_date'] = Carbon::now();
        $updateUser=DB::table('user')->where('user_id','=',$userId)->update($data);
        $getUpdatedUser=DB::table('user')->where('phone','=',$number)->first();
        $this->addLog('Web-UnSubscreption', $number);
        if($updateUser)
        {
            Session::forget('loginUser_subscriptionPlan_Web');
            Session::forget('currentUser_MobileApp');
            session()->put('loginUser_subscriptionPlan_Web',$getUpdatedUser->plan_id);
            session()->forget('currentUser_MobileAkhbaar');
            $sendotp = $this->sendotp($number,'unSub',$otp);
            //return Response::json(['Message'=>'Success Subcribe','responseSendMessage'=>$sendotp,'plan_id'=>$getUpdatedUser->plan_id]);
            $system_logs=$this->system_logs('You have now unsubscribed to Mobile Akhbaar. To subscribe again visit https://bit.ly/2RZahBD','UnSub',$number);
            return Response::json(['status'=>'1']); 
        }
        else
        {
         return Response::json(['status'=>'0']); 
        }
        
    }
    function reniew_Subscreption($user_id)
    {
           $data['plan_id'] = '2';
           $data['trial'] = '0';
          $number=session()->get('loginUser_phone_Web');
           $otp='';
           $charged_User=$this->charging($number,7);
           $charged=json_decode($charged_User, true);
            $this->addLog('Web-ReniewSubscreption', $number);
          //Insuficient Balance
           if($charged['errorCode']=='500.007.05')
           {
            //session()->put('currentUser_MobileAkhbaar',$user_id);
            return Response::json(['status'=>'0','data'=>$charged]);
           }
        //Have Balance
         elseif (isset($charged['Message']) && $charged['Message'] == 'Success') 
           {  
                $requestId = $charged['RequestID'];
                $phone= $number;
                $amount = '7';
                $status= 'success';
                $plan_id= '2';
                $dateCreated =Carbon::now();
                $api_response = $charged;
                $transaction_Logs=$this->Transaction_Logs($requestId,$phone,$amount,$status,$plan_id,$dateCreated,$api_response);
                $data['recharge_date'] = Carbon::now()->addDays(7)->format('Y-m-d');
                $updateUser=DB::table('user')->where('user_id','=',$user_id)->update($data);
                $getUpdatedUser=DB::table('user')->where('phone','=',$number)->first();
                if($updateUser)
                {
                     Session::forget('loginUser_subscriptionPlan_web');
                     session()->put('loginUser_subscriptionPlan_web',$getUpdatedUser->plan_id);
                     session()->put('currentUser_MobileAkhbaar','WebLoginUser');
                    $sendotp = $this->sendotp($number,'Sub',$otp);
                    //return Response::json(['Message'=>'Success Subcribe','responseSendMessage'=>$sendotp,'response Cherged User'=>$charged_User,'plan_id'=>$getUpdatedUser->plan_id]);
                    $system_logs=$this->system_logs('You are Successfully Subcribe this Service','Sub',$number);
                     return Response::json(['status'=>'1','data'=>$system_logs]);
                }
                else
                {
                    return Response::json(['Message'=>'Error While Updating']);
                }
           }
        
    }
    function term_Conditions()
    {
        $this->addLog('Web_TermAndCondition',session()->get('loginUser_phone_Web'));
        return view('News_Frontend_pages.termandcondition');
    }
    function privacy_Policy()
    {
        $this->addLog('Web_PrivacyAndPolicy',session()->get('loginUser_phone_Web'));
        return view('News_Frontend_pages.privacyandpolicy');
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
    function he()
    {
        //return "dasda";
      
        return redirect()->to('http://46.137.194.86/akhbaar_new/public/get_he');
    }
    function he_login()
    {
        $phone=Request::route('phone');
        if(empty($phone))
        {
            $id=db::table('trendingNews_EnglishNews')->select('news_id')->latest('news_id')->first();
            return redirect()->route('userLogin',$id->news_id);
        }
        else
         {
            return redirect()->route('he_UserInsert',$phone);
       }
        
        //return view('News_Frontend_pages.UserLogin.he_login');
    }
    function get_he()
	{
        $phoneNo='';
		$headers = apache_request_headers();
		$ptn = "/^92/";  // Regex
		$rpltxt = "0";  // Replacement string
		if(isset($headers['X-EncryptID']) && $headers['X-EncryptID'] <> ''){
			$phoneNo = $this->decrypted_phone($headers['X-EncryptID']);
			$phone = $this->enc_phone(preg_replace($ptn, $rpltxt, $phoneNo)); 
		}else if(isset($headers['X-Encryptid']) && $headers['X-Encryptid'] <> ''){
			$phoneNo = $this->decrypted_phone($headers['X-Encryptid']);
			$phone = $this->enc_phone(preg_replace($ptn, $rpltxt, $phoneNo)); 
		}else{
			$phone = '';
		}
		return redirect()->to('https://mobileakhbaar.com/akhbaar_new/public/he_login/'.$phoneNo);
	}
    function HeUserInsert($phone)
    {
        $updatePhone=mb_substr($phone,2);
        $this->addLog('He User Insert',$updatePhone);
          $currentDate=Carbon::now()->format('Y-m-d');
        $checkUser=DB::table('user')->where('phone','=',$updatePhone)->first();
        //If User Exist Then call Charging Api
        if($checkUser)
        {
            if($checkUser->recharge_date<$currentDate)
            {
                 $data['plan_id'] = '0';
                 $updateUser=DB::table('user')->where('phone','=', $updatePhone)->update($data);
                 $getUpdatedUser=DB::table('user')->where('phone','=', $updatePhone)->first();
                 if($getUpdatedUser)
                 {
                     session()->put('loginUser_Web',$getUpdatedUser->user_id);
                     session()->put('loginUser_phone_Web','0'.$getUpdatedUser->phone);
                     session()->put('loginUser_subscriptionPlan_Web',$checkUser->plan_id);
                     return redirect()->route('subscriptionPlan');
                 }
                 else
                 {
                     return redirect()->back()->with('error','Error While Update your Subscreption Plan');
                 }
             
            // return redirect()->route('homeEnglish');
                 
                 
            }
            else
            {
                 session()->put('currentUser_MobileAkhbaar','WebLoginUser');
                 session()->put('loginUser_Web',$checkUser->user_id);
                 session()->put('loginUser_phone_Web','0'.$checkUser->phone);
                 session()->put('loginUser_ValidDate_Web',$checkUser->recharge_date);
                 session()->put('loginUser_subscriptionPlan_Web',$checkUser->plan_id);
                  session()->put('loginUser_trial_Web',$checkUser->trial);
                 return redirect()->route('homeEnglish');
            }
         }
         //if User Not Exist 
        else
        {
             $plan_id='2';
             $charged_User=$this->charging('0'.$updatePhone,7);
             $charged=json_decode('0'.$charged_User,true);
             if (isset($charged['errorCode']) && $charged['errorCode'] == '500.007.05')
             {
                  session()->put('currentUser_MobileAkhbaar','WebLoginUser');
                 $message='Your one day free trial for Mobile Akhbaar is activated @Rs.7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw';
                 $type="trial";
                 $trial='1';
                 $creation_date=Carbon::now();
                 $recharged_date=Carbon::now();
                 $saveUser=$this->saveData($updatePhone,$plan_id,$trial,$creation_date,$recharged_date,$type,$message);
                 $sendSms = $this->sendotp($updatePhone,$type);
                 $system_logs=$this->system_logs($message,$type,$updatePhone);
                 return redirect()->route('homeEnglish');
                 
             }
             elseif (isset($charged['Message']) && $charged['Message'] == 'Success')
             {
                  session()->put('currentUser_MobileAkhbaar','WebLoginUser');
                 $message='You are successfully subscribed to Mobile Akhbaar @7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw';
                 $type="Sub";
                 $trial='0';
                 $requestId = $charged['RequestID'];
                 $phone= $SignUp_OTP->number;
                 $amount = '7';
                 $status= 'success';
                 $plan_id= '2';
                 $dateCreated =Carbon::now();
                 $api_response = $charged;
                 $transaction_Logs=$this->Transaction_Logs($requestId,$phone,$amount,$status,$plan_id,$dateCreated,$api_response);
                 $recharged_date=Carbon::now()->addDays(7)->format('Y-m-d');;
                 $saveUser=$this->saveData($SignUp_OTP->number,$plan_id,$trial,$dateCreated,$recharged_date,$type,$message);
                 $sendSms = $this->sendotp($phone,$type);
                 $system_logs=$this->system_logs($message,$type,$phone);
                 return redirect()->route('homeEnglish');
                 
             }
        }
    }
    function rc4($key, $data, $hex = true)
    {
        if ($hex) {
            $key = pack('H*', $key);
        }

        $keys[] = '';
        $boxs[] = '';
        $cipher = '';
        $key_length = strlen($key);
        $data_length = strlen($data);
        for ($i = 0; $i < 256; $i++) {
            $keys[$i] = ord($key[$i % $key_length]);
            $boxs[$i] = $i;
        }

        $j = 0;
        for ($i = 0; $i < 256; $i++) {
            $j = ($j + $boxs[$i] + $keys[$i]) % 256;
            $tmp = $boxs[$i];
            $boxs[$i] = $boxs[$j];
            $boxs[$j] = $tmp;
        }

        $a = 0;
        $j = 0;
        for ($i = 0; $i < $data_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $boxs[$a]) % 256;
            $tmp = $boxs[$a];
            $boxs[$a] = $boxs[$j];
            $boxs[$j] = $tmp;
            $k = $boxs[(($boxs[$a] + $boxs[$j]) % 256)];
            $cipher .= chr(ord($data[$i]) ^ $k);
        }

        return $cipher;
    }
    public function decrypt($key, $data, $hex = false)
    {
        return $this->encrypt($key, $data, $hex);
    } 
	public function decrypted_phone($header)
    {
        $key = "93424ff683d1e616a06711cfa710fc12";
        $y = base64_decode($header);
        $decrypted = $this->rc4($key, $y);
        return $decrypted;
    }
    function enc_phone($phone)
	{
		$ciphering = "AES-128-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		$encryption_iv = '1234567895551441';
		$encryption_key = "Ideation@786";
		$encryption = openssl_encrypt($phone, $ciphering,
					$encryption_key, $options, $encryption_iv);
		return $encryption;
	}
	function dec_phone($encryption)
	{
		$ciphering = "AES-128-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		$decryption_iv = '1234567895551441';
		$decryption_key = "Ideation@786";
		$decryption = openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
		return $decryption;
	}
    function logout_MobileAkhbaar(Request $request)
    { 
        $this->addLog('WebLogout',session()->get('loginUser_phone_Web'));
        session()->flush();
        if(session()->has('Urdu'))
        {
            return redirect()->route('homeUrdu');
        }
        else
        {
            return redirect()->route('homeEnglish');
        }
    }
}
