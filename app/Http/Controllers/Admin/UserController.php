<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\ValidateAll;
use App\Http\Requests\Requests\ValidateUser;
use App\Http\Requests\Requests\ValidateProduct;
use App\Models\Product;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Collection;
use phpDocumentor\Reflection\Types\Object_;

class UserController extends Controller
{
    //show all users in table
    public function   ShowAllUsers()
    {
        $records=[];
        //set the value of searchsql statement to select all
        session (['searchsql'=>"select * from users"]);
        $recordsdb= (DB::select('select * from users'));
        //convert the result to array
        $records=$this->converttoarray($recordsdb);
        return view('auth.Admin.User.showallusers',compact('records'));
    }
    ///Show add new User Form
    public function  ShowStoreUserForm(){return view('auth.Admin.User.addnewuser');}
    /////Store new record to users and profiles tables
    public function   StoreUser(ValidateAll $request)
    {

       ///validate email unique
       // $validator=Validator::make($request->all(),["email"=>"unique:users,email"]);
       // if($validator->fails())
       // return redirect()->back()->withErrors($validator)->withInput($request->all());

        ///Store Account in users table
        $record=new User();
        $record->name=$request->name;
        $record->email=$request->email;
        $record->password=Hash::make($request->password);
        $record->blocked=$request->blocked;
        $record->role=$request->role;
        $record->email_verified_at=time();
        $record->save();

        ///Get Profile record
        $recordprofile=new Profile();
        ///Upload image File
        if($request->image !="")
        {
            $filename=$request->image->getClientOriginalName();
            $filename=time().$filename;
            $request->image->move('images\users\\',$filename);
            $recordprofile->image=$filename;

        }
         $recordprofile->mobile=$request->mobile;
        $recordprofile->address=$request->address;
        $recordprofile->birthdate=$request->birthdate;
        $recordprofile->gender=$request->gender;
        $recordprofile->aboutme=$request->aboutme;
        $recordprofile->user_id=User::select('id')->where('email',$request->email)->first()['id'];
        $recordprofile->save();
        ///Store Pofile in profiles table
         return redirect()->back()->with(["success" => "Member Added Successfully"]);

    }
    ///Show Update Product Form
    public function   ShowUpdateUserForm($id)
    {
        $record=User::find($id);
        return view("auth.Admin.user.updateuser",compact("record"));
    }

    ///Update User in database
    public function   UpdateUser(ValidateAll $request ,$id)
    {
        $record=User::find($id);
        $filename="";
        //check if email exists
        if($request->email!=$record->email)
        {
            $validator = Validator::make($request->all(), ['email' => "unique:users,email"]);
            if ($validator->fails()) return redirect()->back()->withErrors($validator);
        }
        //check if there is input image field
        if($request->image !=null )
        {

            //delete the stored image
            if(file_exists('images\users\\'.$record->profile->image))
                File::delete('images\users\\'.$record->profile->image);

            //store image in public\images\users
            //get the name of image input field
            $filename=$request->image->getClientOriginalName();
            //add time front of the file name
            $filename=time().$filename;
            //store the image file in public\images\users
            $request->image->move("images\users\\",$filename);

        }

        //Update Account Information data
        $record->name=$request->name;
        $record->email=$request->email;
        $record->role=$request->role;
        $record->blocked=$request->blocked;
        if($request->changepassword) $record->password=Hash::make($request->password);
        $record->save();

        //Update Profile Information data
        $recordm=Profile::where('user_id','=',$id)->get()[0];
        $recordm->mobile=$request->mobile;
        $recordm->address=$request->address;
        $recordm->birthdate=$request->birthdate;
        $recordm->gender=$request->gender;
        $recordm->aboutme=$request->aboutme;
    if($filename!='') $recordm->image=$filename;
        $recordm->save();
        return redirect()->back()->with(['success'=>"Member Updated Successfully"]);
    }

    //Delete user From Database
    public function  DeleteUser($id){

        $record=User::find($id);
       if($record->profile && $record->profile->image) {//Delete The Image File of the record
           if (file_exists('images\users\\' . $record->profile->image))
               File::delete('images\users\\' . $record->profile->image);
       }
        $record->delete();
        return redirect()->back()->with(['deletesuccess'=>"Member Deleted Successfully"]);}

    ////function to convert stdclass to array
    private function converttoarray($recordsdb)
    {
        $records=[];
        foreach ($recordsdb as $key=>$value)
            foreach ($value as $mykey=>$myvalue) {$records[$key][$mykey]=$myvalue;
               // if($mykey=="category_id")
                   // $records[$key]['category_name']=Category::select('name')->where('id',$records[$key][$mykey])->first()['name'];

            }
        return $records;
    }
    /// function of table deep search
/// function that execute the search from table according to the search parameters
    public function TabledeepSearch(Request $request)
    {
        $searchname = $request->searchname;
        $searchemail=$request->searchemail;
        $searchrole=$request->searchrole;
        $searchstatus=(int)$request->searchstatus;
//save the search aql statement int searchsql session
        $this->getdeepsearchstatement($searchname,$searchemail,$searchrole,$searchstatus);
        //execute the search sql statemant and convert the resulting stdClass into associative array
        $recordsdb=DB::select(session('searchsql'));
        $records=$this->converttoarray($recordsdb);
        //call the view show all product and pass the records array to it
        $returnHTML = view('auth.Admin.User.showallusers',compact('records'))->render();
        //return the html page to the json request
        return response()->json(['html'=>$returnHTML]);

    }
///function that sets the the search sql statement from name price category search inputs
    public function getdeepsearchstatement($searchname,$searchemail,$searchrole,$searchstatus)
    {
        //intial sql statement value
        $phpsql="select * from users ";
        //add search by name to the sql statement phpsql
        $searchnamex= $searchname=="" ? "'%'":"'%".$searchname."%'";
        $phpsql.="where name like ".$searchnamex;
        //add search by email to the sql statement
        if($searchemail!="")
            $phpsql.=" and email like '%".$searchemail."%'";
        //add search by role to the sql statament
        if($searchrole !="" )
            $phpsql.=" and role ='".$searchrole."'";
        //add search by status to the sql statament
        if($searchstatus !="" )
            $phpsql.=" and blocked =".$searchstatus;

        //save the search sql statement into session
        session(['searchsql'=>$phpsql]);
    }
/////The order table function
    public function OrderTableBy(Request $request)
    {
        //reverse the ordertype (ASC | DESC) when calling the function
        session (['ordertype'=> (session('ordertype')=="ASC") ? "DESC":"ASC"]);
        //read the order field from the request
        $orderbyfield=$request->orderbyfield;
        //append order by field to the search sql statement
        $searchsql=session('searchsql');

            $searchsql.=" order by ".$orderbyfield." ".session('ordertype');
        ///execute the searchsql statement
        $recordsdb=DB::select($searchsql);
        $records=$this->converttoarray($recordsdb);
        //return the html page to the ajax request
        $returnHTML = view('auth.Admin.User.showallusers',compact('records'))->render();
        return response()->json(['html'=>$returnHTML]);


    }


}
