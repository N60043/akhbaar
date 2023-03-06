<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\News;
use App\Models\ActivityLog;
use Request;
use Carbon\Carbon;
class NewsHomeController extends Controller
{
    function homeEnglish()
    {
        session()->forget('view_EnglishAkhbaar');
        session()->forget('view_UrduAkhbaar');
        session()->forget('Urdu');
        session()->put('English', 1);
        $header_Categories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->get();
        $showTrendingNews=db::table('trendingNews_EnglishNews')->limit(5)->get();
        $showNewsSlider = db::table('SliderNews_EnglishNews')->limit(8)->get();
        $showTopStories =db::table('TopStories_EnglishNews')->limit(2)->get();
        $showInternationalNews =db::table('International_EnglishNews')->limit(4)->get();
        $showPoliticsNews =db::table('politics_EnglishNews')->limit(7)->get();
        $showNationalNews =db::table('National_EnglishNews')->limit(4)->get();
        $showSportsNews =db::table('Sports_EnglishNews')->limit(2)->get();
        $newspaper = db::table('newspaper')->where('is_urdu', '=', '0')->get();
        $data = compact('showNewsSlider','showTrendingNews', 'showNationalNews', 'showTopStories', 
        'showPoliticsNews', 'showInternationalNews','showSportsNews','newspaper','header_Categories');
         $this->addLog('WebHomeEnglish');
        return view('News_Frontend_pages.main')->with($data);
    }
    function homeUrdu()
    {
        session()->forget('view_EnglishAkhbaar');
        session()->forget('view_UrduAkhbaar');
        session()->forget('English');
        session()->put('Urdu', 1);
        $header_Categories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->get();
        $showTrendingNews=db::table('trendingNews_UrduNews')->select('news_id','title','urdu_name')->limit(5)->get();
        $showNewsSlider = db::table('SliderNews_UrduNews')->limit(8)->get();
        $showTopStories =db::table('TopStories_UrduNews')->limit(2)->get();
        $showInternationalNews =db::table('International_UrduNews')->limit(4)->get();
        $showPoliticsNews =db::table('politics_UrduNews')->limit(7)->get();
        $showNationalNews =db::table('National_UrduNews')->limit(4)->get();
        $showSportsNews =db::table('Sports_UrduNews')->limit(2)->get();
        $newspaper = db::table('newspaper')->where('is_active', '=', '1')->where('is_urdu', '=', '1')->get();
        $data = compact('showNewsSlider', 'showTrendingNews', 'showNationalNews', 'showTopStories', 'showPoliticsNews',
        'showInternationalNews', 'showSportsNews', 'newspaper','header_Categories');
        $this->addLog('WebHomeUrdu');
        return view('News_Frontend_pages.urduhome')->with($data);

    }
    function detailNews($id)
    {
        $url = url('detailNewsWeb');
        if(session()->has('English'))
        {
            $header_Categories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->get();
        }
        else
        {
            $header_Categories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->get();
        }
        $getRecordbyId = News::where('news_id', '=', $id)->get();
        $getDetailNews_Info = News::where('news_id', '=', $id)->with('getNewsCategory')->with('getNewspaper')->first();
        // if (session()->has('viewAkhbaar')) {
        //     $getNewspaperId_byAkhbaarId = session()->get('viewAkhbaar');
        //     $today_TopRead = db::table('Newspaper_News')->select('news_id', 'title')->where('news_category_id', '=', $getRecordbyId[0]->news_category_id)->where('newspaper_id', '=', $getNewspaperId_byAkhbaarId)->orderBy('news_id', 'DESC')->get();
        //     $showRelatedNews = db::table('Newspaper_News')->select('news_id', 'title','newspaper','img_features','date')->where('news_category_id', '=', $getRecordbyId[0]->news_category_id)->where('newspaper_id', '=', $getNewspaperId_byAkhbaarId)->orderBy('news_id', 'DESC')->inRandomOrder()->limit(4)->paginate(4);
        //     $recentNews = db::table('Newspaper_News')->select('news_id', 'title', 'description')->where('newspaper_id', '=', $getNewspaperId_byAkhbaarId)->orderBy('news_id', 'DESC')->limit(6)->get();
        // }
        //  else {
            $today_TopRead = News::where('news_category_id', '=', $getRecordbyId[0]->news_category_id)->where('newspaper_id','=',$getRecordbyId[0]->newspaper_id)
            ->with('getNewsCategory')->with('getNewspaper')->orderBy('news_id', 'DESC')->Limit(10)->get();
            $showRelatedNews =News::where('news_category_id', '=', $getRecordbyId[0]->news_category_id)->where('newspaper_id','=',$getRecordbyId[0]->newspaper_id)
            ->with('getNewsCategory')->with('getNewspaper')->orderBy('news_id', 'DESC')->limit(4)->get();
            $recentNews =News::where('newspaper_id','=',$getRecordbyId[0]->newspaper_id)
            ->with('getNewsCategory')->with('getNewspaper')->orderBy('news_id', 'DESC')->limit(7)->get();

        //}
        //$this->addLog('WebCategoryDetail',session()->get('loginUser_phone_Web'));
        $detailNews = compact('header_Categories','getDetailNews_Info', 'today_TopRead', 'recentNews', 'showRelatedNews', 'url');
        return view('News_Frontend_pages.detail_News')->with($detailNews);

    }
    function CategoryEnglish($id)
    {
        $header_Categories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->get();
        $categoryNews=News::where('news_category_id','=',$id)
        ->whereIn('newspaper_id',[1,5])->with('getNewspaper')->orderBy('news_id','DESC')->limit(15)->get();
        $data=compact('header_Categories','categoryNews');
        return view('News_Frontend_pages.categoryDetail_English')->with($data);
    }
    function CategoryUrdu($id)
    {
        $header_Categories=db::table('news_category')->where('sort_by','<','13')->orderBy('sort_by')->get();
        $categoryNews=News::where('news_category_id','=',$id)->whereIn('newspaper_id',[3,10,11])
        ->with('getNewspaper')->orderBy('news_id','DESC')->limit(15)->get();
        $data=compact('header_Categories','categoryNews');
        return view('News_Frontend_pages.categoryDetail_Urdu')->with($data);
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
}
