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
Route::get('','frontend\IndexController@GetIndex');
Route::get('about.html','frontend\IndexController@GetAbout');
Route::get('contact.html','frontend\IndexController@GetContact');

Route::get('{slug_cate}.html','frontend\IndexController@GetPrdCate');
Route::get('filter','frontend\IndexController@GetFilter');



Route::group(['prefix' => 'product'], function(){
    Route::get('{slug_prd}.html','frontend\ProductController@GetDetail');
    Route::get('shop','frontend\ProductController@GetShop');
}) ;
Route::group(['prefix' => 'checkout'], function(){
    Route::get('','frontend\CheckOutController@GetCheckout');
    Route::post('','frontend\CheckOutController@PostCheckout');

    Route::get('complete/{order_id}','frontend\CheckOutController@GetComplete');
});

//Cart
Route::group(['prefix' => 'cart'], function(){
    Route::get('','frontend\CartController@GetCart');
    Route::get('add','frontend\CartController@AddCart');
    Route::get('update/{rowId}/{qty}','frontend\CartController@UpdateCart');
    Route::get('del/{rowId}','frontend\CartController@DelCart');



});

//backend


Route::get('login', 'backend\LoginController@GetLogin')->middleware('CheckLogout');
Route::post('login', 'backend\LoginController@PostLogin');


    Route::group(['prefix'=>'admin','middleware'=>'CheckLogin'], function () {
    Route::get('', 'backend\IndexController@GetIndex');
    Route::get('logout', 'backend\IndexController@Logout');

    //category
    Route::group(['prefix' => 'category'], function(){
        Route::get('', 'backend\CategoryController@GetCategory');
        Route::post('', 'backend\CategoryController@PostCategory');
        Route::get('edit/{id_category}', 'backend\CategoryController@GetEditCategory');
        Route::post('edit/{id_category}', 'backend\CategoryController@PostEditCategory');
        Route::get('del/{id_category}', 'backend\CategoryController@DelCategory');


    });

    //order
    Route::group(['prefix' => 'order'], function(){
        Route::get('', 'backend\OrderController@GetOrder');
        Route::get('detail/{id_order}', 'backend\OrderController@GetDetailOrder');
        Route::get('processed', 'backend\OrderController@GetProcessed');
        Route::get('paid/{id_order}', 'backend\OrderController@paid');

    });

      //product
    Route::group(['prefix' => 'product'], function(){
        Route::get('', 'backend\ProductController@GetListProduct');
        Route::get('add', 'backend\ProductController@GetAddProduct');
        Route::post('add', 'backend\ProductController@PostAddProduct');
        Route::get('edit/{id_product}', 'backend\ProductController@GetEditProduct');
        Route::post('edit/{id_product}', 'backend\ProductController@PostEditProduct');
        Route::get('del/{id_product}', 'backend\ProductController@DelProduct');

    });


    //user
    Route::group(['prefix' => 'user'], function(){
        Route::get('', 'backend\UserController@GetListUser');
        Route::get('add', 'backend\UserController@GetAddUser');
        Route::post('add', 'backend\UserController@PostAddUser');

        Route::get('del/{id_user}', 'backend\UserController@DelUser');
        Route::get('edit/{id_user}', 'backend\UserController@GetEditUser');
        Route::post('edit/{id_user}', 'backend\UserController@PostEditUser');


    });




});
