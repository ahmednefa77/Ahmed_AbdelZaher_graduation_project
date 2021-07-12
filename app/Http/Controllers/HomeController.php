<?php

namespace App\Http\Controllers;

use App\Http\Requests\Requests\ValidateAll;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->
        except('SearchCategory','SearchCategoryWelcome',"SearchProductName","ShowOffers");
        //session(['craftitems'=>array(1,2,3)]);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(session('role')=="Admin" || session('role')=="Moderator")
        {
            return view('auth.Admin.dashboard');
        }
        return view("userprofile");
    }
    //function that searches categories in nav bar or in the foooter
    public function SearchCategory($id)
    {
        $records=Product::where('category_id',$id)->get();
        $categoryname=Category::find($id)['name'];
        return view('searchproductsuser',compact('records'))->with(['categoryname'=>$categoryname]);
    }
    //function that searches categories inside the page featured items categories
    public function SearchCategoryWelcome(Request $request)
    {
        $cat=$request->cat;
        ///for Women search the category name = Women
        if($cat=="Women")
       $records=Product::WhereHas('category',function ($q){
            $q->where('name',"Women")->where("sale","none");
        })->get();
        ///for men search the category name = men
        if($cat=="Men")
            $records=Product::WhereHas('category',function ($q){
                $q->where('name',"Men");
            })->get();
        ///for kids search the category name = Kids
        if($cat=="Kids")
            $records=Product::WhereHas('category',function ($q){
                $q->where('name',"Kids");
            })->get();
        ///for all return all products
       if($cat=="All")
        $records=Product::all();
       ///Return the view where records is the search result
 $returnHTML=view('welcome',compact('records'))->render();
      //return html to ajax call
 return response()->json(['html'=>$returnHTML]);
    }
    //function that adds item to the carft
    //carft items are saved as array session
    public function AddToCarft(Request $request)
    {
        $id=$request->id;

      //store selected item in session
        $myitemsarray=session::get('carftitems') !=null ? session::get('carftitems'):array();

      foreach ($myitemsarray as $item)
      if($item==$id)
        return response()->json(['elementexists'=>"Element Exsists"]);

       //$myitemsarray[]=$id;
        array_push($myitemsarray,$id);
        session(['carftitems'=>$myitemsarray]);
        $carftitems=session::get('carftitems');

        $carftitems=count($myitemsarray);
        return response()->json(['carftitems'=>$carftitems]);
    }
    //function that displays the carft items
    public function ShowCarftItems()
    {
        $carftitems=session::get('carftitems');
        if($carftitems!=null)
        $records=Product::whereIn('id',$carftitems)->get();
        else $records=array();
        return view('showcarftitems',compact('records'));
    }
    //function that deletes item from the carft
    public function DeleteCarftItem(Request $request)
    {
        $id=$request->id;
        $carftitems=session::get('carftitems');
      $key=array_search($id,$carftitems);
      unset($carftitems["$key"]);
      session(['carftitems'=>$carftitems]);
      $records=Product::whereIn('id',$carftitems)->get();
      $returnHTML=view('showcarftitems',compact('records'))->render();
      return response()->json(['html'=>$returnHTML,'carftquantity'=>count($carftitems)]);
    }
    //function that displays profile page
    public function ShowProfile()
    {
        $record=User::find(Auth::user()->id);
        return view('profile',compact('record'));
    }
    //function that updates the profile
    public function   UpdateMyProfile(ValidateAll $request )
    {
        $id=Auth::user()->id;
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
    //search product byname function
   public function SearchProductName(Request $request)
   {
       $searchname=$request->searchname;
       $records=Product::where('name',"like","%$searchname%")->get();
       if($searchname=="") $searchname="All";
       return view('searchproductsuser',compact('records'))->with(['categoryname'=>$searchname]);


   }
   ///function that show offers
    public function ShowOffers()
    {
      $records=Offer::all();
      return view('searchproductsuser',compact('records'))->with(['categoryname'=>"Offers"]);
    }
}
