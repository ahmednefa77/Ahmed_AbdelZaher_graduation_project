<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\ValidateAll;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
   /* public function   ShowAllCategorys(){return "الحمد لله";}
    public function  ShowStoreCategoryForm(){return view('auth.Admin.Product.addnewproduct');}
    public function   StoreCategory(){}
    public function   ShowUpdateCategoryForm($id){return "الحمد لله";}
    public function   UpdateCategory($id){return "الحمد لله";}
    public function  DeleteCategory($id){
        $a=Auth::user()->name;;
        return "الحمد لله";}*/
    public function ShowAllCategorys()
    {
        $records = Category::all();

        return view('auth.Admin.Category.showallcategorys', compact('records'));
    }


    ///Add New offer to database table Offer
    public function StoreCategory(ValidateAll $request)
    {
       /*
        ////validate Request Fields
        $validator=Validator::make($request->all(),['newname' =>'required |max:250 |unique:categorys,name'],['newname.required'=>"Please Fill in name",
                'newname.max'=>'The Name Field Must not exceed 250 characters',
                'newname.unique'=>"Error: Category already exists"]
        );
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->with(['updateerror'=>$validator->errors()->first()])->withInput($request->all());
        //////////////////////////*/
        $record=new Category();
        $record->name=$request->newname;
        $record->viewinnav= $request->input('viewinnavnewcategory') ? "view":"hide";

        $record->save();
        return redirect()->back()->with(['success'=>"Category saved successfully"]);


    }
    //////////////////////////
//update offer in database
    public function UpdateCategory(ValidateAll $request,$id)
    {
        /*
        #if category updated name  empty return error message
        if($request->updatename=="" )
            return redirect()->back()->with(['updateerror'=>"Error :Please Fill In Category Name"]);
        #if one of the fields exceeds 250 characters return error

        if(strlen($request->updatename)>250)
            return redirect()->back()->with(['updateerror'=>"Error:Some fields Exceeds 250 chars"]);
        ////validate Request Fields
        $validator=Validator::make($request->all(),['updatename' =>'unique:categorys,name'],['updatename.unique'=>"Error: Category already exists"]
        );
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->with(['updateerror'=>$validator->errors()->first()])->withInput($request->all());
        //////*/
        $record=Category::find($id);
        $record->name=$request->updatename;
        $record->viewinnav= $request->input('viewinnav') ? "view":"hide";
        $record->save();
        return redirect()->back()->with(['successupdate'=>"Category updated successfully"]);

    }
    //Delete slider image and record
    public function  DeleteCategory($id){

        $record=Category::find($id);
        $record->delete();
        return redirect()->back()->with(['deletesuccess'=>"Category Deleted Successfully"]);
//////////////////////
    }




    //
}
