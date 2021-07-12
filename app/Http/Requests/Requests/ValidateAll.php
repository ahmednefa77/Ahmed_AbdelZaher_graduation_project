<?php

namespace App\Http\Requests\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAll extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    private $arrayrules;
    public function __construct()
    {
        ///adding new product validation rules
        $this->arrayrules['newproduct']=['name'=>"required |unique:products,name| max:200 ",
            'price'=>"required | max:200 ",
            'sale' =>"required | max:200 ",
            'category_id'=>"required | max:200 ",
            'details'=>"required | max:4000",
            'image'=>"required | image |max:20000",
        ];
        //////
        ///adding new product validation rules
        $this->arrayrules['updateproduct']=['name'=>"required | max:200 ",
            'price'=>"required | max:200 ",
            'sale' =>"required | max:200 ",
            'category_id'=>"required | max:200 ",
            'details'=>"required | max:4000",
            'image'=>" image |max:20000",
        ];
        ///////
        /// addding new update user/profile validation rules
        $newaccount=['name'=>"required|max:250",
            'email'=>"required|email|max:250 |unique:users,email",
            'password'=>"required|max:250|same:confirmpassword",
            'role'=>"required"];
        $updateaccount=['name'=>"required|max:250",
            'email'=>"required|email|max:250 ",
            'password'=>"required|max:250|same:confirmpassword",
            'role'=>"required"];
        $updatemyaccount=['name'=>"required|max:250",
            'email'=>"required|email|max:250 ",
            'password'=>"required|max:250|same:confirmpassword",
            ];
        $profile=['image'=>'image|max:20000',
            'mobile'=>'max:250',
            'Address'=>'max:250',
            'birthdate'=>"max:250",
            'aboutme'=>'max:250'];
        $this->arrayrules['newuserprofile']=array_merge($newaccount,$profile);
        $this->arrayrules['updateuserprofile']=array_merge($updateaccount,$profile);
        $this->arrayrules['updatemyprofile']=array_merge($updatemyaccount,$profile);
        ////update category rules
        $this->arrayrules['updatecategory']=['updatename'=>"required |max:250"];
        ///add new category rules
        $this->arrayrules['addcategory']=['newname'=>'required |max:250 |unique:categorys,name'];
        ///update offer rules
        $this->arrayrules['updateoffer']=["Quantity"=>"required | max:250",
                           "price_before"=>"required |max:250",
                           "price_after"=>"required | max:250"];
        ///add new offer rule
        $this->arrayrules['newoffer']=['product_name' =>'required |max:250',
                                        'Quantity' =>'required |max:250',
                                         'price_before' =>'required |max:250',
                                          'price_after' =>'required |max:250'];
    }


    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validationtype=$this->request->get('validationtype');
        return $this->arrayrules["$validationtype"];
    }
}
