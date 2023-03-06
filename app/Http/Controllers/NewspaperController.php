<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newspaper;
use App\Models\Newscategory;
use App\Models\Newsmapping;

class NewspaperController extends Controller
{ 
     public function index(Request $request)
    {
        $newspaper_Data=Newspaper::paginate(5);
        $search=$request['search'] ?? '';
       if($search !='')
       {
         $newspaper_Data=Newspaper::where('name','LIKE',"%$search%")->paginate(5);
       }
       else
       {
        $newspaper_Data=Newspaper::paginate(5);
        // $newsMapping_user=Newsmapping::get();
        // $newscategory_user=Newscategory::get();
       }
       $data=compact('newspaper_Data','search');
        return view('AdminPanel.Newspaper.newspaper')->with($data);
    }
  
      public function store(Request $request)
    {
      $newspapercreate=new Newspaper();
       if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/', $filename);
            $newspapercreate->icon=$filename;
        }
      $newspapercreate->name=$_REQUEST['name'];
      $newspapercreate->is_active=$_REQUEST['is_active'];
      $newspapercreate->is_urdu=$_REQUEST['is_urdu'];
      $newspapercreate->save();
      return redirect('viewNewspaper')->with('success','successfully Data Inserted');
          
    }
    public function edit($id)
    {
        $editNewspapar_Info =Newspaper::find($id);
        $data=compact('editNewspapar_Info');
        return view('AdminPanel.Newspaper.editNewspaper')->with($data);
    }
     public function update(Request $request,$id)
    {
    
       $newspaperUpdate=Newspaper::find($id);
         $path = public_path().'/uploads/';
      //code for remove old file
       if($request->hasfile('image'))
        {
            // starts code for Delete the Existing Image
            if($newspaperUpdate->icon != ''  && $newspaperUpdate->icon != null){
                $file_old = $path.$newspaperUpdate->icon;
                unlink($file_old);
           }
     
            // End code for Delete the Existing Image
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/', $filename);
            $newspaperUpdate->icon = $filename;
        }
      $newspaperUpdate->name=$_REQUEST['name'];
      $newspaperUpdate->is_active=$_REQUEST['is_active'];
      $newspaperUpdate->is_urdu=$_REQUEST['is_urdu'];
      $newspaperUpdate->update();
      return redirect('viewNewspaper')->with('success','successfully Data Updated');
                
    }
    public function delete($id)
    {
          $deleteNewsmapping=Newspaper::find($id);
          $deleteNewsmapping->delete();  
          return redirect()->back()->with('error','User is Deleted Successfully');
        
    }
    //  // public function search()
    
    // //      $newspaperInfo=new NewspaperModel();
    // //      $request = service('request');
    // //     $searchData = $request->getGet(); // OR $this->request->getGet();

    // //     $search = "";
    // //     if (isset($searchData) && isset($searchData['search'])) {
    // //         $search = $searchData['search'];
    // //     }

        

    // //     if ($search == '') {
    // //         $paginateData =  $newspaperInfo->paginate(5);
    // //     } else {
    // //         $paginateData =  $newspaperInfo->select('*')
    // //             ->orLike('name', $search)             
    // //             ->paginate(5);
    // //     }
    // //      $datanewspaper=
    // //     [
            
    // //         'users' => $paginateData,
    // //         'pager' => $newspaperInfo->pager,
    // //         'search' => $search,
    // //     ];
    // //      return view('Newspaper/SearchNewspaper.php', $datanewspaper);
    // // }
    // public function search()
    // {
    //      $usersInfo=new UsersModel();
    //     $user_id=session()->get('logged_in');
    //      $newspaperInfo=new NewspaperModel();
    //      $request = service('request');
    //     $searchData = $request->getGet(); // OR $this->request->getGet();

    //     $search = "";
    //     if (isset($searchData) && isset($searchData['search'])) {
    //         $search = $searchData['search'];
    //     }

        

    //     if ($search == '') {
    //         $paginateData =  $newspaperInfo->paginate(5);
    //     } else {
    //         $paginateData =  $newspaperInfo->select('*')
    //             ->orLike('name', $search)             
    //             ->paginate(5);
    //     }
    //      $datanewspaper=
    //     [
    //         'userdata'=> $usersInfo->getUserData($user_id),
    //         'users' => $paginateData,
    //         'pager' => $newspaperInfo->pager,
    //         'search' => $search,
    //     ];
    //      return view('Newspaper/searchnewspaper.php', $datanewspaper);
    // }
    
  
}
