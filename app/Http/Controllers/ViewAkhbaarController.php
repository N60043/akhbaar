<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;
use Request;
use App\Models\Newspaper;
use App\Models\News;

class ViewAkhbaarController extends Controller
{
    function EnglishAkhbaar($id,Request $reqwuest)
    {
        $header_Categories=db::table('news_category')->select('news_category_id','name','sort_by')
        ->where('sort_by','<','13')->orderBy('sort_by')->get();
        $showTrendingNews=db::table('trendingNews_EnglishNews')->where('newspaper_id','=',$id)->limit(5)->get();
        $showNewsSlider = db::table('SliderNews_EnglishNews')->where('newspaper_id','=',$id)->limit(8)->get();
        $showTopStories =db::table('TopStories_EnglishNews')->where('newspaper_id','=',$id)->limit(2)->get();
        $showInternationalNews =db::table('International_EnglishNews')->where('newspaper_id','=',$id)->limit(4)->get();
        $showPoliticsNews =db::table('politics_EnglishNews')->where('newspaper_id','=',$id)->limit(7)->get();
        $showNationalNews =db::table('National_EnglishNews')->where('newspaper_id','=',$id)->limit(4)->get();
        $showSportsNews =db::table('Sports_EnglishNews')->where('newspaper_id','=',$id)->limit(2)->get();
        $newspaper = db::table('newspaper')->where('is_urdu', '=', '0')->get();
        session()->put('view_EnglishAkhbaar',$id);
        $newspaper=Newspaper::where('is_active','=','1')->where('is_urdu','=','0')->get();
             $data=compact('header_Categories','showNewsSlider','showTrendingNews','showNationalNews','showTopStories','showPoliticsNews','showInternationalNews','showSportsNews','newspaper');
        $this->addLog('WebAkhbaarEnglish');
            return view('News_Frontend_pages.main')->with($data);

    }
    function UrduAkhbaar($id,Request $reqwuest)
    {
        $header_Categories=db::table('news_category')->select('news_category_id','urdu_name','sort_by')
        ->where('sort_by','<','13')->orderBy('sort_by')->get();
        $showTrendingNews=db::table('trendingNews_UrduNews')->where('newspaper_id','=',$id)->limit(5)->get();
        $showNewsSlider = db::table('SliderNews_UrduNews')->where('newspaper_id','=',$id)->limit(8)->get();
        $showTopStories =db::table('TopStories_UrduNews')->where('newspaper_id','=',$id)->limit(2)->get();
        $showInternationalNews =db::table('International_UrduNews')->where('newspaper_id','=',$id)->limit(4)->get();
        $showPoliticsNews =db::table('politics_UrduNews')->where('newspaper_id','=',$id)->limit(7)->get();
        $showNationalNews =db::table('National_UrduNews')->where('newspaper_id','=',$id)->limit(4)->get();
        $showSportsNews =db::table('Sports_UrduNews')->where('newspaper_id','=',$id)->limit(2)->get();
             session()->put('view_UrduAkhbaar',$id);
             $newspaper=Newspaper::where('is_active','=','1')->where('is_urdu','=','1')->get();
             $data=compact('header_Categories','showNewsSlider','showTrendingNews','showNationalNews','showTopStories','showPoliticsNews','showInternationalNews','showSportsNews','newspaper');
        $this->addLog('WebAkhbaarUrdu');
            return view('News_Frontend_pages.urduhome')->with($data);
    }
     public function addLog($type=0,$phone=0)
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
}
