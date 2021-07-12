<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\ValidateAll;
use App\Http\Requests\Requests\ValidateProduct;
use App\Models\Category;
use App\Models\Product;


use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use phpDocumentor\Reflection\Types\Object_;
use function MongoDB\BSON\toJSON;

class ProductController extends Controller
{
    use CrudTrait;
    private $recordsstatemenet,$ordertype;
   // public  $dbstat;
    public function __construct()
    {
       session(['ordertype'=>"ASC"]);
       $this->table='products';
       $this->imagepath='images\products\\';
       $this->uniqueupdatefield="name";
       }
    ///Show All products in table
    public function   ShowAllProducts()
    {
       // $this->storerecord("Product","pp");
        $records=[];
        //set the value of searchsql statement to select all
        session (['searchsql'=>"select * from products"]);
        $recordsdb= (DB::select('select * from products'));
        //convert the result to array
        $records=$this->converttoarray($recordsdb);
        return view('auth.Admin.Product.showallproducts',compact('records'));
    }

    ///Show add new Product Form
    public function  ShowStoreProductForm(){return view('auth.Admin.Product.addnewproduct');}

    ///Store Record in Database
    public function   StoreProduct(ValidateAll $request){
    ///ValidateProduct Makes Automatic Validation with supplied rules and messages

     //Store Product Image in public/images/products
       //Make Validation for Image field
        $validator=Validator::make($request->all(),['image' =>"required | image | max:10000",
                                                     ],
            ['image.required'=>"Please Choose Product Image",
            'image.image'=>"Please Choose Image File",
            'image.max' =>"Image File Must Not Exceed 10M",]);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput($request->all());
        $this->StoreRecord("products","images\products\\",$request);
        return redirect()->back()->with(['success'=>"Data saved successfully"]);
/************************************************
        //get the name of image input field
        $filename=$request->image->getClientOriginalName();
        //add time front of the file name
        $filename=time().$filename;
        //store the image file in public\images\products
        $request->image->move("images\products\\",$filename);
        ////Store Request in DataBase Record
        $record=new Product();
        $record->name=$request->name;
        $record->price=$request->price;
        $record->sale=$request->sale;
        $record->category_id=$request->category_id;
        $record->image=$filename;
        $record->details=$request->details;
        $record->save();
        return redirect()->back()->with(['success'=>"Data saved successfully"]);
 *************************************************/
    }
    ///Show Update Product Form
    public function   ShowUpdateProductForm($id)
    {
        $record=Product::find($id);
        return view("auth.Admin.product.updateproduct",compact("record"));
    }

    ///Update Record in database
    public function   UpdateProduct(ValidateAll $request ,$id)
    {
      $result= $this->UpdateRecord("products","images\products\\","id",$id,$request,'name');
       if($result !="0")
       {
           return redirect()->back()->withErrors($result)->withInput($request->all());
       }
        /*
        $record=Product::find($id);
        //check if there is input image field
        if($request->image !=null )
        {
            //delete the stored image
            if(file_exists('images\products\\'.$record->image))
          File::delete('images\products\\'.$record->image);
           ///validate Image as in store function
            $validator=Validator::make($request->all(),['image' =>"required | image | max:10000",
            ],
                ['image.required'=>"Please Choose Product Image",
                    'image.image'=>"Please Choose Image File",
                    'image.max' =>"Image File Must Not Exceed 10M",]);
            if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput($request->all());

            //store image in public\images\products
          //get the name of image input field
            $filename=$request->image->getClientOriginalName();
            //add time front of the file name
            $filename=time().$filename;
            //store the image file in public\images\products
            $request->image->move("images\products\\",$filename);
          ///Update The image name in Database record
           $record->image=$filename;

                    }

        $record->name=$request->name;
        $record->price=$request->price;
        $record->sale=$request->sale;
        $record->category_id=$request->category;

        $record->details=$request->details;
        $record->save();*/
        return redirect()->back()->with(['success'=>"Data Updated Successfully"]);
        }

    //Delete Record From Database
    public function  DeleteProduct($id){
/*
        $record=Product::find($id);
        //Delete The Image File of the record
        if(file_exists('images\products\\'.$record->image))
        File::delete('images\products\\'.$record->image);
        $record->delete();*/
$this->DeleteRecord("products","images\products\\",'id',$id);
        return redirect()->back()->with(['deletesuccess'=>"Product Deleted Successfully"]);}
//////////////////////
/// function of table deep search
/// function that execute the search from table according to the search parameters
public function TabledeepSearch(Request $request)
{
    $searchname = $request->searchname;
    $searchcatid=$request->searchcatid;
    $searchpricefrom=(int)$request->searchpricefrom;
    $searchpriceto=(int)$request->searchpriceto;
//save the search aql statement int searchsql session
    $this->getdeepsearchstatement($searchname,$searchcatid,$searchpricefrom,$searchpriceto);
 //execute the search sql statemant and convert the resulting stdClass into associative array
   $recordsdb=DB::select(session('searchsql'));
   $records=$this->converttoarray($recordsdb);
   //call the view show all product and pass the records array to it
    $returnHTML = view('auth.Admin.Product.showallproducts',compact('records'))->render();
   //return the html page to the json request
    return response()->json(['html'=>$returnHTML]);

}
///function that sets the the search sql statement from name price category search inputs
public function getdeepsearchstatement($searchname,$category_id,$searchpricefrom,$searchpriceto)
{
    //intial sql statement value
   $phpsql="select * from products ";
   //add search by name to the sql statement phpsql
    $searchnamex= $searchname=="" ? "'%'":"'%".$searchname."%'";
   $phpsql.="where name like ".$searchnamex;
   //add search by category to the sql statement
   if($category_id!="")
       $phpsql.=" and category_id = ".$category_id;
   //add search by price to the sql statament
   if($searchpricefrom !="" and $searchpriceto !="")
   $phpsql.=" and price >=".$searchpricefrom." and price <=".$searchpriceto;
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
   if ($orderbyfield=="price") $searchsql.=" order by cast(".$orderbyfield." as unsigned) ".session('ordertype');
   elseif ($orderbyfield=="sale") $searchsql.=" order by cast(".$orderbyfield." as unsigned) ".session('ordertype');
   else
   $searchsql.=" order by ".$orderbyfield." ".session('ordertype');
   ///execute the searchsql statement
   $recordsdb=DB::select($searchsql);
   $records=$this->converttoarray($recordsdb);
   //return the html page to the ajax request
   $returnHTML = view('auth.Admin.Product.showallproducts',compact('records'))->render();
    return response()->json(['html'=>$returnHTML]);


}
//function to convert stdclass to array
    private function converttoarray($recordsdb)
    {
        $records=[];
        foreach ($recordsdb as $key=>$value)
            foreach ($value as $mykey=>$myvalue) {$records[$key][$mykey]=$myvalue;
                if($mykey=="category_id")
                    $records[$key]['category_name']=Category::select('name')->where('id',$records[$key][$mykey])->first()['name'];

            }
        return $records;
    }
}
