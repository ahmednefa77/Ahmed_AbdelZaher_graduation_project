<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function   ShowAllSliders()
    {
        $records=Slider::all();

        return view('auth.Admin.Slider.showallsliders',compact('records'));
    }
    //

    ///Add New slider to database table Slider
    public function StoreSlider(Request $request)
    {
        ////validate image file image file must be required ,Image file,max size 20M Bytes
        $validator=Validator::make($request->all(),['image' =>'required | image | max:20000'],
            ['image.required'=>"Error: Please Choose Image File",
                'image.image'=>"Error: Please Choose Valid Image File"
            ,"image.max"=>"Error: Image size Must Not Exceed 20MB"]);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->with(['updateerror'=>$validator->errors()->first()]);
        //////////////////////////
        /// Upload image file
        //get the name of image input field
        $filename=$request->image->getClientOriginalName();
        //add time front of the file name
        $filename=time().$filename;
        //store the image file in public\images\sliders
        $request->image->move("images\sliders\\",$filename);

        ///Store image file name in slider table
        $record=new Slider();
        $record->image=$filename;
        $record->save();
        return redirect()->back()->with(['success'=>"Data saved successfully"]);


    }
    //////////////////////////
    /// Update slider db record
    public function UpdateSlider(Request $request,$id)
    {

        ////validate image file image file must be required ,Image file,max size 20M Bytes
        $validator=Validator::make($request->all(),['imageupdate' =>'required | image | max:20000'],
            ['imageupdate.required'=>"Error: Please Choose Image File",
                'imageupdate.image'=>"Error: Please Choose Valid Image File",
                "imageupdate.max"=>"Error: Image size Must Not Exceed 20MB"]);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->with(['updateerror'=>$validator->errors()->first()]);

        ////delete exisisting image
        $record=Slider::find($id);
        if(file_exists('images\sliders\\'.$record->image))
            File::delete('images\sliders\\'.$record->image);

        /// Upload new image file
        //get the name of image input field
        $filename=$request->imageupdate->getClientOriginalName();
        //add time front of the file name
        $filename=time().$filename;
        //store the image file in public\images\sliders
        $request->imageupdate->move("images\sliders\\",$filename);

        ///Store image file name in slider table

        $record->image=$filename;
        $record->save();
        return redirect()->back()->with(['successupdate'=>"Slider updated successfully"]);
    }
    //Delete slider image and record
    public function  DeleteSlider($id){

        $record=Slider::find($id);
        //Delete The Image File of the record
        if(file_exists('images\sliders\\'.$record->image))
            File::delete('images\sliders\\'.$record->image);
        $record->delete();
        return redirect()->back()->with(['deletesuccess'=>"Image Deleted Successfully"]);}
//////////////////////
}
