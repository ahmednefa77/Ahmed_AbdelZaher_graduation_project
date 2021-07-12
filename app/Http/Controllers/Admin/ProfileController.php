<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Profile;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function   ShowAllProfiles()
    {
        $records=[];
        //set the value of searchsql statement to select all
        session (['searchsql'=>"select * from profiles"]);
        $recordsdb= (DB::select('select * from profiles'));
        //convert the result to array
        $records=$this->converttoarray($recordsdb);
        return view('auth.Admin.Profile.showallprofiles',compact('records'));
    }
    /////////
    /// function that execute the search from table according to the search parameters
    public function TableDeepSearch(Request $request)
    {

       global $searchemail,$searchname;
        $searchname = $request->searchname;
       $searchemail =$request->searchemail;
        $searchmobile=$request->searchmobile;
        $searchaddress=$request->searchaddress;
        $searchgender=$request->searchgender;
        $searchagefrom=$request->searchagefrom;
        $searchageto=$request->searchageto;


 $recordsdb=Profile::whereHas('user', function ($q){
            global $searchemail,$searchname;
            $q->where ([["name",'like',"%$searchname%"],['email',"like","%$searchemail%"]]);})
          -> get()->toArray();

          $records=$this->converttoarray($recordsdb);
        $returnHTML = view('auth.Admin.Profile.showallprofiles',compact('records'))->render();
        //return the html page to the json requestint
        return response()->json(['html'=>$returnHTML]);

    }
///function that sets the the search sql statement from name price category search inputs
    public function getdeepsearchstatement($searchname,$searchemail,$searchmobile,$searchaddress,
                                           $searchgender,$searchagefrom,$searchageto)

    {
        //intial sql statement value
        $phpsql="select * from profiles ";
        //add search by name to the sql statement phpsql
        $searchnamex= $searchname=="" ? "'%'":"'%".$searchname."%'";
        //$phpsql.="where mobile like ".$searchnamex;
       $phpsql.=" 
   WHERE mobile ='ahmed'";//.$searchnamex;
      /*  //add search by category to the sql statement
        if($category_id!="")
            $phpsql.=" and category_id = ".$category_id;
        //add search by price to the sql statament
        if($searchpricefrom !="" and $searchpriceto !="")
            $phpsql.=" and price >=".$searchpricefrom." and price <=".$searchpriceto;
        //save the search sql statement into session */
        session(['searchsql'=>$phpsql]);
    }


    private function converttoarray($recordsdb)
    {
        $records=[];
        foreach ($recordsdb as $key=>$value)
            foreach ($value as $mykey=>$myvalue) {
                $records[$key][$mykey]=$myvalue;
                if($mykey=="user_id")
                 {
                     $records[$key]['user_email']=User::select('email')->where('id',$records[$key][$mykey])->first()['email'];
                     $records[$key]['user_name']=User::select('name')->where('id',$records[$key][$mykey])->first()['name'];
                 }
            }


        return $records;
    }

}
