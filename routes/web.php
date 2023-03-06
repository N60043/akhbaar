<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\NewsHomeController;
use App\Http\Controllers\NewspaperController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewscategoriesController;
use App\Http\Controllers\NewsmappingController;
use App\Http\Controllers\NewsSliderController;
use App\Http\Controllers\NewsHomeDetailController;
use App\Http\Controllers\ViewAkhbaarController;
use App\Http\Controllers\MobileNewsController;
use App\Models\News;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;
use App\Models\SignUpOTP;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('sub',[NewsController::class,'Sub'])->name('sub');
Route::post('NewsubotpVerfication',[NewsController::class,'NewSubverifyOTP'])->name('NewsubotpVerfication');
Route::get('UnSub',[NewsController::class,'UnSub'])->name('UnSub');
Route::post('New_UnsubotpVerfication',[NewsController::class,'NewUnSubverifyOTP'])->name('New_UnsubotpVerfication');
Route::get('loginnew',function()
{
	// $header_Categories=db::table('Newspaper_News')->distinct('news_category_id')->select('news_id','category')->where('newspaper_id','=','1')->orwhere('newspaper_id','=','5')->groupBy('news_category_id')->orderBy('news_id','DESC')->limit(6)->get();
	// $data=compact('header_Categories');
	return view('Sub_login');
});
Route::get('unsubnew',function()
{
	// $header_Categories=db::table('Newspaper_News')->distinct('news_category_id')->select('news_id','category')->where('newspaper_id','=','1')->orwhere('newspaper_id','=','5')->groupBy('news_category_id')->orderBy('news_id','DESC')->limit(6)->get();
	// $data=compact('header_Categories');
	return view('UnSub_login')->with($data);
});
// Route::get('SubNewOtpVerifypage',function()
// {
// 	$header_Categories=db::table('Newspaper_News')->distinct('news_category_id')->select('news_id','category')->where('newspaper_id','=','1')->orwhere('newspaper_id','=','5')->groupBy('news_category_id')->orderBy('news_id','DESC')->limit(6)->get();
// 	$data=compact('header_Categories');
// 	return view('subotpverification')->with($data);
// });
Route::get('loginUnSub',function()
{
	return view('unsub');
});
$agent = new Agent();
// agent detection Mobile View
Route::get('/',function()
{
	$agent = new Agent();
	if(!$agent->isMobile())
	{
		return redirect()->route('homeEnglish');
	}
	else
	{
	 return redirect()->route('Home-MobileAkhbaar');
	}
});
// Route::get('system_logs/{message}/{type}/{phone}',[MobileNewsController::class,'system_logs']);
Route::get('sessionCheck',function()
{
 print_r(session()->all());	
});
Route::get('sessionDestroy',function()
{
 print_r(session()->flush());	
});
Route::get('he',[Auth::class,'he'])->name('he');
Route::get('get_he',[Auth::class,'get_he'])->name('get_he');
Route::get('he_UserInsert/{phone}',[Auth::class,'HeUserInsert'])->name('he_UserInsert');
Route::get('he_login/{phone?}',[Auth::class,'he_login'])->name('he_login');
//Route::get('/checkConecction',[Auth::class,'checkConnection']);
Route::get('/homeUrdu',[NewsHomeController::class,'homeUrdu'])->name('homeUrdu');
 Route::get('HomeEnglish',[NewsHomeController::class,'homeEnglish'])->name('homeEnglish');
// ---------------------Routes For View Web Akbaar Data---------------------------------------
// agent detection Mobile View
Route::get('view_EnglishAkhbaar/{id}',[ViewAkhbaarController::class,'EnglishAkhbaar'])->name('EnglishAkhbaar');
Route::get('view_UrduAkhbaar/{id}',[ViewAkhbaarController::class,'UrduAkhbaar'])->name('UrduAkhbaar');
// ---------------------Routes for Detail News--------------------------------------------
Route::get('checkInfo/{phoneNumber}',[Auth::class,'check_info']);
Route::get('sendotp/{phone}/{type}/{otp}',[Auth::class,'sendotp']);
Route::get('get_token',[Auth::class,'get_token']);

Route::get('otpCheck',[Auth::class,'otp'])->name('optError');
Route::get('detailNewsWeb/{id}',[NewsHomeController::class,'detailNews'])->name('detailNewsWeb');
Route::get('categoryEnglish/{id}',[NewsHomeController::class,'CategoryEnglish'])->name('categoryDetailEnglish');
Route::get('categoryUrdu/{id}',[NewsHomeController::class,'CategoryUrdu'])->name('categoryDetailUrdu');
Route::group(['prefix' => '', 'middleware' => 'logout_AkhbaarWeb'], function() {
	
	Route::get('logout_MobileAkhbaar',[Auth::class,'logout_MobileAkhbaar'])->name('logout_MobileAkhbaar');
	Route::get('Profile',[Auth::class,'ViewProfile'])->name('ViewProfile_Web');
});
Route::get('SubscriptionPlan',[Auth::class,'plan_Subscription'])->name('subscriptionPlan');
Route::post('unSubsribed/{id}',[Auth::class,'un_Subscribe'])->name('Unsubscribed_webUser');
Route::post('SubsriptionPlan/{id}',[Auth::class,'reniew_Subscreption'])->name('reniew_SubsPlan');
Route::get('TermAndCondition',[Auth::class,'term_Conditions'])->name('term_and_Condition');
Route::get('PrivacyPolicy',[Auth::class,'privacy_Policy'])->name('privacy_policy');


// -------------------------------------------------- Routes For Mobile View Data --------------------------------------------

Route::group(['prefix' => '','middleware' => 'login_MobileAkhbaar'], function() {
    Route::get('userLogin/{id}',[Auth::class,'userLogin'])->name('userLogin');
    Route::get('otpCheck/',[Auth::class,'otp'])->name('optError');
    Route::post('insertOTP/',[Auth::class,'insertOTP'])->name('insertOTP');
    Route::get('OTP/',[Auth::class,'otpPage'])->name('otpPage');
    Route::post('VerifyOTP',[Auth::class,'verifyOTP'])->name('VerifyOTP');
    Route::get('signIn/{id}',[MobileNewsController::class,'signIn'])->name('signIn');
	Route::get('otpMobilePage',[MobileNewsController::class,'otpMobile'])->name('otpMobilePage');
	Route::post('OtpInsert',[MobileNewsController::class,'insertOTP'])->name('OTPInsert');
	Route::post('OTPVerifying',[MobileNewsController::class,'verifyOTP'])->name('OTPVerifying');
});
Route::group(['prefix' => '','middleware' => 'logout_MobileAkhbaar'], function() {
  Route::get('detailNews/{id}',[MobileNewsController::class,'categoryDetail'])->name('categoryDetail');
});
Route::get('MobileAkhbaar',[MobileNewsController::class,'homeMobile'])->name('Home-MobileAkhbaar'); 
Route::get('MobileAkhbaar/akhbaarNews/{id}',[MobileNewsController::class,'akhbaarNews'])->name('akhbaarNews');
Route::get('MobileAkhbaar/CategoryNews/{id}',[MobileNewsController::class,'newsCategory'])->name('CategoryNews');
Route::get('ViewNewspapers',[MobileNewsController::class,'viewNewspapers'])->name('Newspapers');
Route::get('Search',[MobileNewsController::class,'search'])->name('Search');
Route::get('getSearch',[MobileNewsController::class,'getSearchNews'])->name('news.search');
Route::get('addBookmark/{id}',[MobileNewsController::class,'addBookmark'])->name('insertBookmark');
Route::get('MobileAkhbaar/getBookmarkNews/{id}',[MobileNewsController::class,'getBookmarkNews'])->name('getBookmark');
// Route::get('delete_bookmarks/{id}',[MobileNewsController::class,'delete_Bookmarks'])->name('delete_Bookmarks');
Route::get('Bookmark',[MobileNewsController::class,'bookmark'])->name('bookmark');
Route::get('Setting',[MobileNewsController::class,'setting'])->name('ViewSetting');
Route::get('Setting/Profile',[MobileNewsController::class,'ViewProfile'])->name('ViewProfile');
Route::get('Setting/ProfileSubscription',[MobileNewsController::class,'plan_Subscription'])->name('planandsubscription');
Route::post('Setting/unSubsribe/{id}',[MobileNewsController::class,'un_Supscribe'])->name('userUnsubscribe');
Route::post('Setting/reniew_Subsribtion/{id}',[MobileNewsController::class,'reniew_Subsribtion'])->name('reniew_Subsribtion');
Route::get('Setting/ProfileTermCondition',[MobileNewsController::class,'term_Conditions'])->name('termandcondition');
Route::get('Setting/ProfilePrivacyPolicy',[MobileNewsController::class,'privacy_Policy'])->name('privacyandpolicy');
Route::get('Setting/ProfileContactUs',[MobileNewsController::class,'contactUs'])->name('contacUs');
Route::get('SignInUserMobile',[MobileNewsController::class,'userLogin'])->name("MobileUser");
Route::get('otpmainPage',[MobileNewsController::class,'otp'])->name('otpmaninPage');
Route::get('logoutMobile',[MobileNewsController::class,'logout_MobileUser'])->name('logoutMobile');
Route::get('heMobilApp',[MobileNewsController::class,'he'])->name('heMobilApp');
Route::get('get_heMobilApp',[MobileNewsController::class,'get_he'])->name('get_heMobile');
Route::get('he_UserInsertMobilApp/{phone}',[MobileNewsController::class,'HeUserInsert'])->name('he_UserInsertMobilApp');
Route::get('he_loginMobilApp/{phone?}',[MobileNewsController::class,'he_login'])->name('he_loginMobilApp');
Route::get('otpverfyiong',function()
{
 return view('MobileView.MobileUserLogin.otpVerfication');
});
// ---------------------Routes for Login Registration--------------------------------------------
Route::group(['prefix' => '', 'middleware' => 'AlreadyLoginAdmin'], function() {
	Route::get('/adminLogin',[Auth::class,'login']);
	Route::get('register',[Auth::class,'register']);
	Route::post('register/store',[Auth::class,'store']);
	Route::post('login/Checker',[Auth::class,'loginCheck']);
});
Route::get('logout',[Auth::class,'logout']);
Route::get('viewNews',[NewsController::class,'index']);
Route::group(['prefix' => '', 'middleware' => 'adminNotLogin'], function() {
Route::get('/dashboard',[Auth::class,'view']);
//-------------------------------------Routes for News----------------------------------

Route::get('createNews',[NewsController::class,'create']);
Route::post('storenews',[NewsController::class,'store']);
Route::get('editNews/{id}',[NewsController::class,'edit']);
Route::put('updateNews/{id}',[NewsController::class,'update']);
Route::get('deleteNews/{id}',[NewsController::class,'delete']);
// Route::get('searchNews',[NewsController::class,'search']);


// // ---------------------Routes for Newspaper--------------------------------------------


Route::get('viewNewspaper',[NewspaperController::class,'index']);
Route::post('createnewspaper',[NewspaperController::class,'store']);
Route::get('editNewspaper/{id}', [NewspaperController::class,'edit']);
Route::put('updateNewspaperRecord/{id}',[NewspaperController::class,'update']);
Route::get('deleteNewspaper/{id}',[NewspaperController::class,'delete']);
// $routes->get('searchNewspaper',[NewspaperController::class,'search']);

// // -------------------Routes for NewsCategories-------------------------------

Route::get('viewNewsCategory',[NewscategoriesController::class,'index']);
Route::post('createnewsCategories',[NewscategoriesController::class,'store']);
Route::get('editNewsCategories/{id}',[NewscategoriesController::class,'edit']);
Route::put('updateNewscategoryRecord/{id}',[NewscategoriesController::class,'update']);
Route::get('deleteNewsCategories/{id}',[NewscategoriesController::class,'delete']);
// $routes->get('searchNewspaperCategory',[NewscategoriesController::class,'search']);

// //-------------------------Routes for NewsMapping----------------------------------
Route::get('viewNewsMapping',[NewsmappingController::class,'index']);
Route::get('createnewsmapping',[NewsmappingController::class,'create']);
Route::post('storenewsmapping',[NewsmappingController::class,'store']);
Route::get('editNewsmapping/{id}',[NewsmappingController::class,'edit']);
Route::put('updateNewsmapping/{id}',[NewsmappingController::class,'update']);
Route::get('deleteNewsmapping/{id}',[NewsmappingController::class,'delete']);

// // ---------------------Routes for News Slider--------------------------------------------


Route::get('viewNewslider',[NewsSliderController::class,'index']);
Route::get('createNewsslider',[NewsSliderController::class,'create']);
Route::post('storenewsslider',[NewsSliderController::class,'store']);
Route::get('editNewsslider/{id}', [NewsSliderController::class,'edit']);
Route::put('updateNewssliderRecord/{id}',[NewsSliderController::class,'update']);
Route::get('deleteNewsslider/{id}',[NewsSliderController::class,'delete']);
// $routes->get('searchNewspaper',[NewspaperController::class,'search']);
});
route::get('checkInfo',function()
{
});

