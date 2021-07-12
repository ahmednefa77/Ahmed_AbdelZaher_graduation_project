<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/zaza', function () {
    return view('welcome');
});
////Category CRUD
Route::group(['prefix'=>'admin/category','namespace'=>'Admin'],function (){

    Route::group(['middleware'=>'AdminORModerator'],function() {
        Route::get('/showallcategorys', "CategoryController@ShowAllCategorys")->name('showallcategorysrt');
        Route::get('showstorecategoryform', "CategoryController@ShowStoreCategoryForm")->name('showstorecategoryformrt');
        Route::post('storecategory', "CategoryController@StoreCategory")->name('storecategoryrt');

    });

    Route::group(['middleware'=>"AdminOnly"],function() {
        Route::post('updatecategory/{id}', "CategoryController@UpdateCategory")->name('updatecategoryrt');
        Route::post('deletecategory/{id}', "CategoryController@DeleteCategory")->name('deletecategoryrt');
    });
});
////////////////////////////////////////////////////////
///Product CRUD
Route::group(['prefix'=>'admin/product','namespace'=>'Admin'],function (){

    Route::group(['middleware'=>'AdminORModerator'],function() {
        Route::get('/showallproducts', "ProductController@ShowAllProducts")->name('showallproductsrt');
        Route::get('showstoreproductform', "ProductController@ShowStoreProductForm")->name('showstoreproductformrt');
        Route::post('storeproduct', "ProductController@StoreProduct")->name('storeproductrt');
        Route::get('tabledeepsearch', "ProductController@TableDeepSearch")->name('tabledeepsearchrt');
        Route::get('ordertableby', "ProductController@OrderTableBy")->name('ordertablebyrt');
        Route::get('showupdateproductform/{id}', "ProductController@ShowUpdateProductForm")->name('showupdateproductformrt');


    });

    Route::group(['middleware'=>'AdminOnly'],function() {
        Route::post('updateproduct/{id}', "ProductController@UpdateProduct")->name('updateproductrt');
        Route::post('deleteproduct/{id}', "ProductController@DeleteProduct")->name('deleteproductrt');
    });
});
//////////////////////////////////////
/////Slider CRUD
Route::group(['prefix'=>'admin/slider','namespace'=>'Admin'],function () {

    Route::group(['middleware'=>'AdminORModerator'], function () {
        Route::get('/showallsliders', "SliderController@ShowAllSliders")->name('showallslidersrt');
        Route::post('storeslider', "SliderController@StoreSlider")->name('storesliderrt');

    });

    Route::group(['middleware'=>"AdminOnly"], function () {
        Route::post('updateslider/{id}', "SliderController@UpdateSlider")->name('updatesliderrt');
        Route::post('deleteslider/{id}', "SliderController@DeleteSlider")->name('deletesliderrt');
    });
});
//////////////////////////////////////
/////Offer CRUD
    Route::group(['prefix'=>'admin/offer','namespace'=>'Admin'],function (){

        Route::group(['middleware'=>'AdminORModerator'],function() {
            Route::get('/showalloffers', "OfferController@ShowAllOffers")->name('showalloffersrt');
            Route::post('storeoffer', "OfferController@StoreOffer")->name('storeofferrt');

        });

        Route::group(['middleware'=>"AdminOnly"],function() {
            Route::post('updateoffer/{id}', "OfferController@UpdateOffer")->name('updateofferrt');
            Route::post('deleteoffer/{id}', "OfferController@DeleteOffer")->name('deleteofferrt');
        });

});
///////////////////////////////////////////////////////
///User CRUD
Route::group(['prefix'=>'admin/user','namespace'=>'Admin'],function (){

    Route::group(['middleware'=>'AdminORModerator'],function() {
        Route::get('/showallusers', "UserController@ShowAllUsers")->name('showallusersrt');
        Route::get('showstoreuserform', "UserController@ShowStoreUserForm")->name('showstoreuserformrt');
        Route::post('storeuser', "UserController@StoreUser")->name('storeuserrt');
        Route::get('tabledeepsearchuser', "UserController@TableDeepSearch")->name('tabledeepsearchuserrt');
        Route::get('orderusertableby', "UserController@OrderTableBy")->name('orderusertablebyrt');
        Route::get('showupdateuserform/{id}', "UserController@ShowUpdateUserForm")->name('showupdateuserformrt');

    });

    Route::group(['middleware'=>'AdminOnly'],function() {
        Route::post('updateuser/{id}', "UserController@UpdateUser")->name('updateuserrt');
        Route::post('deleteuser/{id}', "UserController@DeleteUser")->name('deleteuserrt');
    });
});
//////////////////////////////////////
///Profile CRUD
Route::group(['prefix'=>'admin/profile','namespace'=>'Admin'],function (){

    Route::group(['middleware'=>'AdminORModerator'],function() {
        Route::get('/showallprofiles', "ProfileController@ShowAllProfiles")->name('showallprofilesrt');
         Route::get('tabledeepsearchprofile', "ProfileController@TableDeepSearch")->name('tabledeepsearchprofilert');
        Route::get('orderprofiletableby', "ProfileController@OrderTableBy")->name('orderprofiletablebyrt');
        Route::get('showupdateprofileform/{id}', "UserController@ShowUpdateUserForm")->name('showupdateprofileformrt');

    });

    Route::group(['middleware'=>'AdminOnly'],function() {
        Route::post('updateprofile/{id}', "UserController@UpdateUser")->name('updateprofilert');
        Route::post('deleteprofile/{id}', "UserController@DeleteUser")->name('deleteprofilert');
    });
});
//////////////////////////////////////

