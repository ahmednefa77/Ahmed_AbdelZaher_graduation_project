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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('layouts.Adminmaster');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth',"verified");
Route::get('searchcategory/{id}','HomeController@SearchCategory')->name('searchcategoryrt');
Route::get("searchcategorywelcome","HomeController@SearchCategoryWelcome")->name('searchcategorywelcomert');
Route::get("addtocraft","HomeController@AddToCarft")->name("addtocraftrt");
Route::get("showcarftitems","HomeController@ShowCarftItems")->name('showcarftitemsrt');
Route::get("deletecarftitem","HomeController@DeleteCarftItem")->name("deletecraftitemrt");
Route::get("showprofile","HomeController@ShowProfile")->name('showprofilert');
Route::post('updatemyprofile',"HomeController@UpdateMyProfile")->name('updatemyprofilert');
Route::get('searchproductname',"HomeController@SearchProductName")->name('searchproductnamert');
Route::get("showoffers","HomeController@ShowOffers")->name("showoffersrt");
