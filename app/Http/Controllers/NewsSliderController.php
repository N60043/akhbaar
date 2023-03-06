<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsSlider;
use App\Models\Newspaper;

class NewsSliderController extends Controller
{
     public function index(Request $request)
    {
       $search=$request['search'] ?? '';
       if($search !='')
       {
         $newsslider_Data=NewsSlider::where('title','LIKE',"%$search%")->paginate(5);
       }
       else
       {
        $newsslider_Data=NewsSlider::paginate(5);
       }
       $data=compact('newsslider_Data','search');
        return view('AdminPanel.NewsSlider.newsslider')->with($data);
    }
     public function create(Request $request)
    {
    $newspaper_user=Newspaper::select('id','name')->get();
    $data=compact('newspaper_user');
   
    return view('AdminPanel.NewsSlider.createNewsslider')->with($data);
       
    }
  
      public function store(Request $request)
    {
      $newsSlidercreate=new NewsSlider();
       if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/', $filename);
            $newsSlidercreate->image=$filename;
        }
      $newsSlidercreate->newspaper_id=$_REQUEST['newspaper_id'];
      $newsSlidercreate->title=$_REQUEST['title'];
      $newsSlidercreate->description=$_REQUEST['descript'];
      $newsSlidercreate->is_active=$_REQUEST['is_active'];
      $newsSlidercreate->is_urdu=$_REQUEST['is_urdu'];
      $newsSlidercreate->slider_order=$_REQUEST['slider_order'];
      $newsSlidercreate->save();
      return redirect('viewNewslider')->with('success','successfully Data Inserted');
          
    }
    public function edit($id)
    {
        $editNewsslider_Info =NewsSlider::find($id);
        $newspaper_user=Newspaper::select('id','name')->get();
        $data=compact('editNewsslider_Info','newspaper_user');
        return view('AdminPanel.NewsSlider.editNewsslider')->with($data);
    }
     public function update(Request $request,$id)
    {
      $newsSliderupdate=NewsSlider::find($id);
      $path = public_path().'/uploads/';
       if($request->hasfile('image'))
        {
            // starts code for Delete the Existing Image
            if($newsSliderupdate->image != ''  && $newsSliderupdate->image != null){
                $file_old = $path.$newsSliderupdate->image;
                unlink($file_old);
           }
     
            // End code for Delete the Existing Image
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/', $filename);
            $newsSliderupdate->image = $filename;
        }
      $newsSliderupdate->newspaper_id=$_REQUEST['newspaper_id'];
      $newsSliderupdate->title=$_REQUEST['title'];
      $newsSliderupdate->description=$_REQUEST['descript'];
      $newsSliderupdate->is_active=$_REQUEST['is_active'];
      $newsSliderupdate->is_urdu=$_REQUEST['is_urdu'];
      $newsSliderupdate->slider_order=$_REQUEST['slider_order'];
      $newsSliderupdate->update();
      return redirect('viewNewslider')->with('success','successfully Data Updated');
                
    }
    public function delete($id)
    {
          $deleteNewsslider=NewsSlider::find($id);
          $deleteNewsslider->delete();  
          return redirect()->back()->with('error','User is Deleted Successfully');
        
    }
    public function detailNews_Slider($id)
    {
        $url=url('detailNews_Slider');
        $getDetailNews_Info =NewsSlider::where('slider_id',$id)->firstOrFail();
        $showRelatedNews=NewsSlider::select('slider_id','news_id','title')->where('is_active','=','1')->get();
        $recentNews=NewsSlider::latest()->select('slider_id','news_id','title','description')->get();
        $detailNewsSlider=compact('getDetailNews_Info','recentNews','showRelatedNews','url');
        return view('News_Frontend_pages.detail_News')->with($detailNewsSlider);

    }
    
}
