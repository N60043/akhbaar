<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Newsmapping;
use App\Models\Newscategory;
use App\Models\Newspaper;


class NewsmappingController extends Controller
{
    public function index(Request $request)
    {
     
             $search=$request['search'] ?? '';
               if($search !='')
               {
                 $newsMapping_user=Newsmapping::where('newspaper_cat_name','LIKE',"%$search%")->paginate(5);
               }
               else
               {
       
                $newsMapping_user=Newsmapping::paginate(5);
               }
                $data=compact('newsMapping_user','search');
               
            return view('AdminPanel.Newsmapping.newsmapping')->with($data);
       
    }

     public function create(Request $request)
    {
    $newspaper_user=Newspaper::get();
    $newscategory_user=Newscategory::get();
    $data=compact('newspaper_user','newscategory_user');
   
    return view('AdminPanel.Newsmapping.createNewsmapping')->with($data);
       
    }

   public function store(Request $request)
    {


      $newsmappingcreate=new Newsmapping();
      $newsmappingcreate->newspaper_id=$_REQUEST['newspaper_id'];
      $newsmappingcreate->newspaper_cat_name=$_REQUEST['newspaper_cat_name'];
      $newsmappingcreate->news_category_id=$_REQUEST['news_category_id'];
      $newsmappingcreate->category_url=$_REQUEST['category_url'];
      $newsmappingcreate->save();
      return redirect('viewNewsMapping')->with('success','successfully Data Inserted');
            
          
    }
    public function edit($id)
    {
        
        $newsMapping_Data=
            [
            'editnewsmapping'=>Newsmapping::find($id),
            'newspaper_user'=>Newspaper::get(),
            'newscategory_user'=>Newscategory::get(),
            ];

        return view('AdminPanel.Newsmapping.editNewsmapping')->with($newsMapping_Data);
    }
     public function update(Request $request,$id)
    {
      $newsmappingupdate=Newsmapping::find($id);
      $newsmappingupdate->newspaper_id=$_REQUEST['newspaper_id'];
      $newsmappingupdate->newspaper_cat_name=$_REQUEST['newspaper_cat_name'];
      $newsmappingupdate->news_category_id=$_REQUEST['news_category_id'];
      $newsmappingupdate->category_url=$_REQUEST['category_url'];
      $newsmappingupdate->update();
      return redirect('viewNewsMapping')->with('success','successfully Data Updated');
    }
    public function delete($id = null)
    {
        
          $deleteNewsmapping=Newsmapping::find($id);
          $deleteNewsmapping->delete();  
          return redirect()->back()->with('error','User is Deleted Successfully');
        
    }
    // public function search(Request $request)
    // {
    //     $search=$_REQUEST['search'] ?? '';
    //    if($search !='')
    //    {
    //      $newsMapping_user=Newsmapping::where('news_category_name','LIKE',"%$search%")->paginate(5);
    //    }
    //    else
    //    {
    //     $newsMapping_user=Newsmapping::paginate(5);
    //     $newspaper_user=Newspaper::get();
    //     $newscategory_user=Newscategory::get();

    //     }
    //     $data=compact('newsMapping_user','newspaper_user','newscategory_user','search');
    //      return view('AdminPanel.Newsmapping.newsmapping')->with($data);
        
    // }
}
