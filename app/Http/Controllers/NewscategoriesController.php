<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newscategory;

class NewscategoriesController extends Controller
{
 public function index(Request $request)
    {
      $datanewscategory=Newscategory::paginate(10);
      $search=$request['search'] ?? '';
       if($search !='')
       {
         $datanewscategory=Newscategory::where('name','LIKE',"%$search%")->paginate(10);
       }
       else
       {

        $datanewscategory=Newscategory::paginate(10);
       }
        $data=compact('datanewscategory','search');
        return view('AdminPanel.Newscategory.newscategories')->with($data);
    }
  
      public function store(Request $request)
    {


      $newscategorycreate=new Newscategory();
      $newscategorycreate->name=$_REQUEST['eng_name'];
      $newscategorycreate->urdu_name=$_REQUEST['urdu_name'];
      $newscategorycreate->sort_by=$_REQUEST['sort_by'];
      $newscategorycreate->save();
      return redirect('viewNewsCategory')->with('success','successfully Inserted');
            
          
    }
    public function edit($id)
    {
        $newscategoryInfo=new Newscategory();
        $edit_newscategory=$newscategoryInfo->find($id);
        $data=compact('edit_newscategory');
        return view('AdminPanel.Newscategory.editNewscategory')->with($data);
         
       
    }
     public function update(Request $request,$id)
    {
       $newscategoryInfo=new Newscategory();
       $update_newscategory=$newscategoryInfo->find($id);
       $update_newscategory->name=$_REQUEST['eng_name'];
       $update_newscategory->urdu_name=$_REQUEST['urdu_name'];
       $update_newscategory->sort_by=$_REQUEST['sort_by'];
       $update_newscategory->update();
       return redirect('viewNewsCategory')->with('success','successfully Updated');
    
    }
    public function delete($id)
    {
        
          $deleteNewscategory=Newscategory::find($id);
          $deleteNewscategory->delete();  
          return redirect()->back()->with('error','News Category is Deleted Successfully');
        
    }
    // public function search()
    // {
    //      $usersInfo=new UsersModel();
    //      $user_id=session()->get('logged_in');
    //      $newscategoryInfo=new NewscategoriesModel();
    //      $request = service('request');
    //      $searchData = $request->getGet(); // OR $this->request->getGet();

    //     $search = "";
    //     if (isset($searchData) && isset($searchData['search'])) {
    //         $search = $searchData['search'];
    //     }

        

    //     if ($search == '') {
    //         $paginateData = $newscategoryInfo->paginate(5);
    //     } else {
    //         $paginateData = $newscategoryInfo->select('*')
    //             ->orLike('name', $search)             
    //             ->paginate(5);
    //     }
    //      $datanewspapercategory=
    //     [
    //         'userdata'=> $usersInfo->getUserData($user_id),
    //         'users' => $paginateData,
    //         'pager' => $newscategoryInfo->pager,
    //         'search' => $search,
    //     ];
    //      return view('Newscategory/searchnewscategory.php', $datanewspapercategory);
    // }

}
