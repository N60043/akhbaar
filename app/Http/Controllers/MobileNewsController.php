<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Models\User2;
use App\Models\SignUpOTP;
use App\Models\NewsSlider;
use App\Models\News;
use App\Models\Newspaper;
use App\Models\Bookmark;
use App\Models\ActivityLog;
use Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Hash;
use Session;
use Response;

class MobileNewsController extends Controller
{
    function homeMobile()
    {
         session()->forget('akhbaarNews');
         session()->forget('NewspaperNameById');
         $headerCategories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->get();
        $newsHome=News::with('getNewspaper')->with('getNewsCategory')->with('getBookmark')->orderBy('news_id','DESC')->limit(21)->get();
        //  $bookmark=Bookmark::select('*')->with('getNews')->get();
        // echo($newsHome);
        // die();
         $newsData=compact('headerCategories','newsHome');
         $this->addLog('MobileHome');
        return view('MobileView.mobileHome')->with($newsData);
    }
    function newsCategory($id)
    {
     if(session()->has('akhbaarNews'))
         {
            //$getNewsCategoryById=News::where('news_category_id','=',$id)->get();
            $headerCategories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->limit(6)->get();
            $newsHome=News::where('news_category_id','=',$id)->where('newspaper_id','=',session()->get('akhbaarNews'))->with('getNewspaper')->with('getBookmark')->limit(21)->get();
         }
     else
         {
           //$getNewsCategoryById=News::select('news_category_id')->where('news_id','=',$id)->get();
           $headerCategories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->limit(6)->get();
            $newsHome=News::where('news_category_id','=',$id)->with('getNewspaper')->orderBy('news_id','DESC')->with('getBookmark')->limit(21)->get();

        }
     $newsData=compact('headerCategories','newsHome');
     $this->addLog('Mobile-NewsCategory',session()->get('loginUser_phone'));
     return view('MobileView.CategoryNews')->with($newsData);
    }
    function categoryDetail($id)
    {
       
        $headerCategories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->limit(6)->get();;
        $url=url('detailNews');
        $getRecordbyId=News::where('news_id','=',$id)->get();
        $getDetailNews_Info =News::where('news_id','=',$id)->with('getNewspaper')->with('getBookmark')->firstOrFail();
        if(session()->has('akhbaarNews'))
        { 
            $latestNews =News::where('news_category_id','=',$getRecordbyId[0]->news_category_id)->where('newspaper_id','=',session()->get('akhbaarNews'))->orderBy('news_id','DESC')->limit(10)->get();
            $showRelatedNews=News::where('news_category_id','=',$getRecordbyId[0]->news_category_id)->where('newspaper_id','=',session()->get('akhbaarNews'))->with('getNewspaper')->orderBy('news_id','DESC')->limit(20)->get();
        }
        else
        {
            $latestNews =News::where('news_category_id','=',$getRecordbyId[0]->news_category_id)->orderBy('news_id','DESC')->limit(10)->get();
            $showRelatedNews=News::where('news_category_id','=',$getRecordbyId[0]->news_category_id)->with('getNewspaper')->orderBy('news_id','DESC')->limit(20)->get();
        }
        $this->addLog('Mobile-CategoryDetail',session()->get('loginUser_phone'));
        $newsCategoryData=compact('headerCategories','getDetailNews_Info','latestNews','showRelatedNews','url');
        return view('MobileView.mobileCategoryDetail')->with($newsCategoryData);
    }
    function viewNewspapers()
    {
        $getNewspaper=Newspaper::where('is_active','=','1')->get();
        $newspaper=compact('getNewspaper');
         $this->addLog('Mobile-NewspaperPage',session()->get('loginUser_phone'));
        return view('MobileView.viewNewspapers')->with($newspaper);
    }
    function akhbaarNews($id)
    {
         $headerCategories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->limit(6)->get();
         $newsHome=News::where('newspaper_id','=',$id)->with('getNewspaper')->with('getBookmark')->orderBy('news_id','DESC')->limit(20)->get();
        $getNewspaperById=Newspaper::select('name')->where('id','=',$id)->limit(1)->firstOrFail();
        session()->forget('NewspaperNameById');
        session()->forget('akhbaarNews');
        session()->put('NewspaperNameById',$getNewspaperById->name);
        session()->put('akhbaarNews',$id);
        $this->addLog('Mobile-AkhbbaarNews',session()->get('loginUser_phone'));
        $dataNewspaper=compact('headerCategories','newsHome','id');
        return view('MobileView.mobileHome')->with($dataNewspaper);
    }
    function addBookmark($id)
    {
       $getRecordById=News::select('news_id','title','description','date','img_features')->where('news_id','=',$id)->get();
       $bookmark=new Bookmark();
       $getBookmarkRecord=Bookmark::select('news_id')->get();
       $getRecordBookmarksById=Bookmark::where('news_id','=',$id)->first();
       if($bookmark->count()==0)
       {
        $setIn_ActiveValue=1;
        $bookmark->news_id=$getRecordById[0]->news_id;
        $bookmark->title=$getRecordById[0]->title;       
        $bookmark->description=$getRecordById[0]->description;
        $bookmark->date=$getRecordById[0]->date;
        $bookmark->img=$getRecordById[0]->img_features;
        $bookmark->is_active=$setIn_ActiveValue;
        $bookmark->save();
        return redirect()->back();
       }
       else
       {
         if(is_null($getRecordBookmarksById))
         {
            $setIn_ActiveValue=1;
            $bookmark->news_id=$getRecordById[0]->news_id;
            $bookmark->title=$getRecordById[0]->title;       
            $bookmark->description=$getRecordById[0]->description;
            $bookmark->date=$getRecordById[0]->date;
            $bookmark->img=$getRecordById[0]->img_features;
            $bookmark->is_active=$setIn_ActiveValue;
            $bookmark->save();
            return redirect()->back();
         }
         else
         {
            $getRecordBookmarksById->delete();
             return redirect()->back();
         }
          $this->addLog('Mobile-AddBookmark',session()->get('loginUser_phone'));
       }
    }
    function bookmark()
    {
        $getBookmarkdata=Bookmark::select('*')->orderBy('bookmark_id','DESC')->get();
        $bookmarkData=compact('getBookmarkdata');
         $this->addLog('Mobile-BookmarkPage',session()->get('loginUser_phone'));
        return view('MobileView.bookmarks')->with($bookmarkData);
    }
    function getBookmarkNews($id)
    {
      $headerCategories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->limit(6)->get();
        $newsHome=News::with('getNewspaper')->with('getBookmark')->where('news_id','=',$id)->get();
        $newsData=compact('headerCategories','newsHome','id');
         $this->addLog('Mobile-BookmarkDeatil',session()->get('loginUser_phone'));
        return view('MobileView.mobileHome')->with($newsData);
    }
    public function search()
    {
        $this->addLog('Mobile-SearchPage',session()->get('loginUser_phone'));
        return view('MobileView.search');
    }
    public function getSearchNews(Request $request)
    {
         $this->addLog('Mobile-GetSearchRecord',session()->get('loginUser_phone'));
        $newsHome = News::where('title', 'LIKE', "%{$request->search}%")->get();
        return view('MobileView.newsSearchData', compact('newsHome'))->with(
        ['search' => $request->search])->render();
    }
    function setting()
    {
         $this->addLog('Mobile-Setting',session()->get('loginUser_phone'));
        return view('MobileView.setting');
    }
    function viewProfile()
    {
         $this->addLog('Mobile-UserProfile',session()->get('loginUser_phone'));
        return view('MobileView.viewProfile');
    }
    function plan_Subscription()
    {
         $this->addLog('Mobile-planAndSubcription-Page',session()->get('loginUser_phone'));
        return view('MobileView.planandSubscription');
    }
    function un_Supscribe($userId)
    {
        $number=session()->get('loginUser_phone');
        $otp='';
        $data['plan_id'] = '0';
        $data['deactivate_date'] = Carbon::now();
        $updateUser=DB::table('user')->where('user_id','=',$userId)->update($data);
        $getUpdatedUser=DB::table('user')->where('phone','=',$number)->first();
        $this->addLog('Mobile-UnSubscreption', $number);
        if($updateUser)
        {
            Session::forget('currentUser_MobileApp');
            Session::forget('loginUser_subscriptionPlan');
             session()->put('loginUser_subscriptionPlan',$getUpdatedUser->plan_id);
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
    function reniew_Subsribtion($user_id)
    {
		$data['plan_id'] = '2';
        $data['trial'] = '0';
       $number=session()->get('loginUser_phone');
       $otp='';
       $charged_User=$this->charging($number,7);
	   $charged=json_decode($charged_User, true);
        $this->addLog('Mobile-ReniewSubscreption', $number);
	  //Insuficient Balance
	   if($charged['errorCode']=='500.007.05')
	   {
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
				 Session::forget('loginUser_subscriptionPlan');
				 session()->put('loginUser_subscriptionPlan',$getUpdatedUser->plan_id);
                 session()->put('currentUser_MobileApp','MobileLoginUser');
				$sendotp = $this->sendotp($number,'Sub',$otp);
				//return Response::json(['Message'=>'Success Subcribe','responseSendMessage'=>$sendotp,'response Cherged User'=>$charged_User,'plan_id'=>$getUpdatedUser->plan_id]);
				$system_logs=$this->system_logs('You are Successfully Subcribe this Service','Sub',$number);
				 return Response::json(['status'=>'1']);
			}
			else
			{
				return Response::json(['Message'=>'Error While Updating']);
			}
	   }
        
    }
    function term_Conditions()
    {
        $this->addLog('Mobile_TermAndCondition',session()->get('loginUser_phone_Web'));
        return view('MobileView.termandCondition');
    }
    function privacy_Policy()
    {
        $this->addLog('Mobile_PrivacyAndPolicy',session()->get('loginUser_phone_Web'));
        return view('MobileView.privacyandPolicy');
    }
    function contactUs()
    {
        $this->addLog('Mobile_ContactUs',session()->get('loginUser_phone_Web'));
        return view('MobileView.contactUs');
    }
    public function signIn($id)
    {
        session()->forget('news_idMobile');
       session()->put('news_idMobile',$id);
       return redirect()->to('http://46.137.194.86/akhbaar_new/public/get_heMobilApp');
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
		return redirect()->to('https://mobileakhbaar.com/akhbaar_new/public/he_loginMobilApp/'.$phoneNo);
	}
    function he_login()
    {
        $phone=Request::route('phone');
        if(empty($phone))
        {
            $this->addLog('Mobile-loginPage');
            return view('MobileView.MobileUserLogin.signIn');
        }
        else
         {
            return redirect()->route('he_UserInsertMobilApp',$phone);
         }
        
        //return view('News_Frontend_pages.UserLogin.he_login');
    }
    function HeUserInsert($phone)
    {
        $news_id=session()->get('news_idMobile');
        $updatePhone=mb_substr($phone,2);
        $this->addLog('He User Insert',$updatePhone);
          $currentDate=Carbon::now()->format('Y-m-d');
         
        $checkUser=DB::table('user')->where('phone','=',$updatePhone)->first();
        echo $currentDate.' '.$checkUser->recharge_date;
        //If User Exist Then call Charging Api
        if($checkUser)
        {
            // session()->put('currentUser_MobileApp','WebLoginUser');
            // return redirect()->route('categoryDetail', $news_id);
            if($checkUser->recharge_date<$currentDate)
            {
                $data['plan_id'] = '0';
                 $updateUser=DB::table('user')->where('phone','=',$updatePhone)->update($data);
                 $getUpdatedUser=DB::table('user')->where('phone','=',$updatePhone)->first();
                 if($getUpdatedUser)
                 {
                      session()->put('loginUser',$getUpdatedUser->user_id);
                     session()->put('loginUser_subscriptionPlan',$getUpdatedUser->plan_id);
                       session()->put('loginUser_phone','0'.$getUpdatedUser->phone);
                     return redirect()->route('planandsubscription');
                 }
                 else
                 {
                     return redirect()->back()->with('error','Error While Update your Subscreption Plan');
                 }
             // session()->put('currentUser_MobileApp',$news_id);
             //     session()->put('loginUser',$checkUser->user_id);
             //     session()->put('loginUser_phone','0'.$checkUser->phone);
             //     session()->put('loginUser_ValidDate',$checkUser->recharge_date);
             //     session()->put('loginUser_subscriptionPlan',$checkUser->plan_id);
             //      session()->put('loginUser_trial',$checkUser->trial);
             //     return redirect()->route('categoryDetail', $news_id);
            }
            else
            {
                 session()->put('currentUser_MobileApp','MobileLoginUser');
                 session()->put('loginUser',$checkUser->user_id);
                 session()->put('loginUser_phone','0'.$checkUser->phone);
                 session()->put('loginUser_ValidDate',$checkUser->recharge_date);
                 session()->put('loginUser_subscriptionPlan',$checkUser->plan_id);
                  session()->put('loginUser_trial',$checkUser->trial);
                 return redirect()->route('categoryDetail', session()->get('news_idMobile'));
            }
         }
         //if User Not Exist 
        else
        {
             $plan_id='2';
             $charged_User=$this->charging('0'.$updatePhone,7);
             $charged=json_decode($charged_User,true);
             if (isset($charged['errorCode']) && $charged['errorCode'] == '500.007.05')
             {
                session()->put('currentUser_MobileApp','WebLoginUser');
                 $message='Your one day free trial for Mobile Akhbaar is activated @Rs.7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw';
                 $type="trial";
                 $trial='1';
                 $creation_date=Carbon::now();
                 $recharged_date=Carbon::now();
                 $saveUser=$this->saveData($news_id,$updatePhone,$plan_id,$trial,$creation_date,$recharged_date,$type,$message);
                 $sendSms = $this->sendotp($updatePhone,$type);
                 $system_logs=$this->system_logs($message,$type,$updatePhone);
                 return redirect()->route('categoryDetail',session()->get('news_idMobile'));
                 
             }
             elseif (isset($charged['Message']) && $charged['Message'] == 'Success')
             {
                session()->put('currentUser_MobileApp','MobileLoginUser');
                 $message='You are successfully subscribed to Mobile Akhbaar @7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw';
                 $type="Sub";
                 $trial='0';
                 $requestId = $charged['RequestID'];
                 $phone= $updatePhone;
                 $amount = '7';
                 $status= 'success';
                 $plan_id= '2';
                 $dateCreated =Carbon::now();
                 $api_response = $charged;
                 $transaction_Logs=$this->Transaction_Logs($requestId,$phone,$amount,$status,$plan_id,$dateCreated,$api_response);
                 $recharged_date=Carbon::now()->addDays(7)->format('Y-m-d');;
                 $saveUser=$this->saveData($news_id,$SignUp_OTP->number,$plan_id,$trial,$dateCreated,$recharged_date,$type,$message);
                 $sendSms = $this->sendotp($phone,$type);
                 $system_logs=$this->system_logs($message,$type,$phone);
                 return redirect()->route('categoryDetail', session()->get('news_idMobile'));
                 
             }
        }
           
    }
    function otpMobile()
    {
      $this->addLog('Mobile-OtpPage');
     return view('MobileView.MobileUserLogin.otpVerfication');
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
     $this->addLog('Mobile-insertOTP',$phoneNumber);
      $res = json_decode($checkInfo, true);

        $customerType = (isset($res['CustomerType']) && !empty($res['CustomerType'])) ? $res['CustomerType'] : '';
        $assetStatus = (isset($res['AssetStatus']) && !empty($res['AssetStatus'])) ? $res['AssetStatus'] : '';
        if ($assetStatus == 'Active')
        {
            $signup_OTP->save();
            $sendotp = $this->sendotp($phoneNumber,'pass',$otp);
			$messageBody = 'Your one time password for Mobile Akhbaar is '.$otp;
			$system_logs=$this->system_logs($messageBody,'pass',$phoneNumber);
             return Response::json(['status'=>0,'data'=> json_decode($sendotp,true) ]); 
        }
            else
            {
            return Response::json(['status'=>1,'Error'=>'Sorry!This Service is Currently Available for Telenor Users.']);
            }
    } 
    function verifyOTP(Request $request)
    {
            $news_id=session()->get('news_id');
            $digit1=$_REQUEST['digit1'];
            $digit2=$_REQUEST['digit2'];
            $digit3=$_REQUEST['digit3'];
            $digit4=$_REQUEST['digit4'];
            $currentDate=Carbon::now()->format('Y-m-d');
            $getOTP=$digit1 .= $digit2 .=$digit3 .=$digit4;
            $SignUp_OTP=DB::table('signup_otp')->select('id','number','otp')->latest('id','desc')->first();
            session()->put('currentUser_MobileApp','WebLoginUser');
            return redirect()->route('categoryDetail',session()->get('news_idMobile'));
            if($SignUp_OTP->otp==$getOTP)
            {
                $this->addLog('verifyOTP_Mobile',$SignUp_OTP->number);
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
                                session()->put('loginUser',$getUpdatedUser->user_id);
                                session()->put('loginUser_subscriptionPlan',$getUpdatedUser->plan_id);
                                session()->put('loginUser_phone','0'.$getUpdatedUser->phone);
                                return redirect()->route('planandsubscription');
                            }
                            else
                            {
                                return redirect()->back()->with('error','Error While Update your Subscreption Plan');
                            }
                        // session()->put('currentUser_MobileApp',$news_id);
                        //     session()->put('loginUser',$checkUser->user_id);
                        //     session()->put('loginUser_phone','0'.$checkUser->phone);
                        //     session()->put('loginUser_ValidDate',$checkUser->recharge_date);
                        //     session()->put('loginUser_subscriptionPlan',$checkUser->plan_id);
                        //      session()->put('loginUser_trial',$checkUser->trial);
                        //     return redirect()->route('categoryDetail', $news_id);
                    }
                    else
                    {
                            session()->put('currentUser_MobileApp','MobileLoginUser');
                            session()->put('loginUser',$checkUser->user_id);
                            session()->put('loginUser_phone','0'.$checkUser->phone);
                            session()->put('loginUser_ValidDate',$checkUser->recharge_date);
                            session()->put('loginUser_subscriptionPlan',$checkUser->plan_id);
                            session()->put('loginUser_trial',$checkUser->trial);
                            return redirect()->route('categoryDetail', session()->get('news_idMobile'));
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
                            session()->put('currentUser_MobileApp','WebLoginUser');
                            $message='Your one day free trial for Mobile Akhbaar is activated @Rs.7/week inc of Tax. To unsubscribe click https://bit.ly/3i2KyTw';
                            $type="trial";
                            $trial='1';
                            $creation_date=Carbon::now();
                            $recharged_date=Carbon::now();
                            $saveUser=$this->saveData($news_id,$SignUp_OTP->number,$plan_id,$trial,$creation_date,$recharged_date,$type,$message);
                            $sendSms = $this->sendotp($SignUp_OTP->number,$type);
                            $system_logs=$this->system_logs($message,$type,$SignUp_OTP->number);
                            return redirect()->route('categoryDetail', session()->get('news_idMobile'));
                            
                        }
                        elseif (isset($charged['Message']) && $charged['Message'] == 'Success')
                        {
                            session()->put('currentUser_MobileApp','MobileLoginUser');
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
                            $saveUser=$this->saveData($news_id,$SignUp_OTP->number,$plan_id,$trial,$dateCreated,$recharged_date,$type,$message);
                            $sendSms = $this->sendotp($phone,$type);
                            $system_logs=$this->system_logs($message,$type,$phone);
                            return redirect()->route('categoryDetail', session()->get('news_idMobile'));
                            
                        }
                }
                    
                }
            else
            {
                $this->addLog('Mobile OPT Verifing Error',$SignUp_OTP->number);
                return redirect()->route('otpMobilePage')->with('error','You Enter a Wrong OTP');
            }
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
    function saveData($id,$number,$plan_id,$trial,$dateCreated,$recharge_date,$type,$message)
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
        session()->put('currentUser_MobileApp',$id);
        session()->put('loginUser',$getUpdatedUser->user_id);
        session()->put('loginUser_phone','0'.$getUpdatedUser->phone);
        session()->put('loginUser_ValidDate',$getUpdatedUser->recharge_date);
        session()->put('loginUser_subscriptionPlan',$getUpdatedUser->plan_id);
        session()->put('loginUser_trial',$getUpdatedUser->trial);
				
             
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
    function he()
    {
        //return "dasda";
      
        return redirect()->to('http://46.137.194.86/akhbaar_new/public/get_he');
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
    function decrypt($key, $data, $hex = false)
    {
        return $this->encrypt($key, $data, $hex);
    } 
	
    function decrypted_phone($header)
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
    function logout_MobileUser(Request $request)
    { 
        $this->addLog('Mobile_Logout',session()->get('loginUser_phone'));
        session()->flush();
        return redirect('MobileAkhbaar');
    }
}
