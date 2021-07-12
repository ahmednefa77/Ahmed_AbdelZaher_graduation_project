<?php
namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

Trait CrudTrait
{
    public function sayallah()
    {
        dd("الله اكبر");
    }
    public $table;
    public $imagepath;
    public $uniqueupdatefield;

    public function StoreRecord($table,$imagepath, $request)
    {
        //$table=$this->table;
        //$imagepath=$this->imagepath;
        //$records = DB::select("select * from $table");
       // $records=$request;
        ///Set the record keys  to the request equivalent keys
        $record=[];
        /*foreach ($records as $mrecord){
            foreach ($mrecord as $field => $value) {
                if ($field == 'id' || $field == "image") continue;
                if (isset($request["$field"]))
                    $record["$field"] = $request["$field"];
            }}*/
      $fields=DB::getSchemaBuilder()->getColumnListing($table);
      foreach ($fields as $field) {
          if ($field == 'id' || $field == "image") continue;
          if (isset($request["$field"]))
              $record["$field"] = $request["$field"];
      }
        /// upload image and save image field name if exists
        if (isset($request['image']) && Schema::hasColumn("$table",'image')) {
            $filename = $request->image->getClientOriginalName();
            //add time front of the file name
            $filename = time() . $filename;
            //store the image file in public\images\products
            $request->image->move($imagepath, $filename);
            //set the image field name of the image in table
            $record['image'] = $filename;
        }
        //store the record to database
        DB::table("$table")->insert($record);
    }

    public function UpdateRecord( $table,$imagepath,$keyfield, $keyvalue, $request,$uniquefield)
    {   //$table=$this->table;
        // $imagepath=$this->imagepath;
        // $uniquefield=$this->uniqueupdatefield;
        ///make validation if only Unique Field is changed
        if ($uniquefield != "") {
            $oldunique = DB::table("$table")->where($keyfield, $keyvalue)->pluck("$uniquefield")[0];
            if ($request["$uniquefield"] != $oldunique) {
                ///if unique field changed then make unique validation on this field
                $validator = Validator::make($request->all(), ["$uniquefield" => "unique:$table,$uniquefield"]);
                ///if validation fails return $validator
                if ($validator->fails()) return $validator;
            }
        }
        /*
        $records = DB::select("select * from $table");
        ///Set the record keys  to the request equivalent keys
        foreach ($records as $mrecord)
            foreach ($mrecord as $field => $value) {
                if ($field == $keyfield || $field == "image") continue;
                if (isset($request["$field"]))
                    $record["$field"] = $request["$field"];
            }*/
        $fields=DB::getSchemaBuilder()->getColumnListing($table);
        foreach ($fields as $field) {
            if ($field == 'id' || $field == "image") continue;
            if (isset($request["$field"]))
                $record["$field"] = $request["$field"];
        }
        /// delete , upload image and save image field name if exists
        /// check if table has image field && also the request && request image is filled
        if (isset($request['image']) && $request['image'] != "" && Schema::hasColumn("$table",'image')) {
            //Delete Old image
            //get the name of old image
            $recordimage = DB::table("$table")->where($keyfield, $keyvalue)->pluck('image');
            //Delete The Image File of the record
            if (file_exists($imagepath . $recordimage[0]))
                File::delete($imagepath . $recordimage[0]);

            /////////////////
            //upload new image
            //get the name of image in request
            $filename = $request->image->getClientOriginalName();
            //add time front of the file name
            $filename = time() . $filename;
            //store the image file in image path
            $request->image->move($imagepath, $filename);
            //save the image name to table
            $record['image'] = $filename;
        }
        //update record in table
        DB::table("$table")->where($keyfield, $keyvalue)->update($record);
        return "0";
    }

    //Delete Record From Database
    public function DeleteRecord( $table,$imagepath,$keyfield, $keyvalue)
    {
       // $table=$this->table;
       // $imagepath=$this->imagepath;
       // check if table has image field if it exists delete corresponding image
        if (Schema::hasColumn("$table",'image')) {
            $recordimage = DB::table("$table")->where($keyfield, $keyvalue)->pluck('image');
            //Delete The Image File of the record
            if (file_exists($imagepath . $recordimage[0]))
            { File::delete($imagepath . $recordimage[0]);}
        }
        DB::table("$table")->where($keyfield, $keyvalue)->delete();
//////////////////////
    }
}
