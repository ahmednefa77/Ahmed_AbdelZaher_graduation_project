<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\ValidateAll;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class OfferController extends Controller
{
    public function ShowAllOffers()
    {
        $records = Offer::all();

        return view('auth.Admin.Offer.showalloffers', compact('records'));
    }


    ///Add New offer to database table Offer
    public function StoreOffer(ValidateAll $request)
    {   /*
        ////validate Request Fields
        $validator=Validator::make($request->all(),['product_name' =>'required |max:250','Quantity' =>'required |max:250','price_before' =>'required |max:250','price_after' =>'required |max:250']
            );
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->with(['updateerror'=>'Error : Please ReFill in Errored Fields'])->withInput($request->all());
        //////////////////////////*/
        $record=new Offer();
        $record->product_id=$request->product_name;
        $record->Quantity=$request->Quantity;
        $record->price_before=$request->price_before;
        $record->price_after=$request->price_after;
        $record->save();
        return redirect()->back()->with(['success'=>"Offer saved successfully"]);


    }
    //////////////////////////
//update offer in database
    public function UpdateOffer(ValidateAll $request,$id)
    {

        #if one of the request fields are empty return error message
       /* if($request->Quantity=="" || $request->price_before=="" || $request->price_after=="")
            return redirect()->back()->with(['updateerror'=>"Error: Please Fill In all Fields Some fields look empty"]);
         #if one of the fields exceeds 250 characters return error

        if(strlen($request->Quantity)>250 || strlen($request->price_before)>250 || strlen($request->price_after)>250)
            return redirect()->back()->with(['updateerror'=>"Error: Some fields Exceeds 250 chars"]);
*/
        $record=Offer::find($id);
      $record->Quantity=$request->Quantity;
      $record->price_before=$request->price_before;
      $record->price_after=$request->price_after;
      $record->save();

        return redirect()->back()->with(['successupdate'=>"Offer updated successfully"]);

    }
    //Delete slider image and record
    public function  DeleteOffer($id){

        $record=Offer::find($id);
        $record->delete();
        return redirect()->back()->with(['deletesuccess'=>"Offer Deleted Successfully"]);
//////////////////////
}
}
