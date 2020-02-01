<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'v1','namespace'=>'Api'],function (){
    Route::get('cities','MainController@cities');
    Route::get('regions','MainController@regions');
    Route::get('categories','MainController@categories');
    Route::get('restaurants','MainController@restaurants');
    Route::get('products','MainController@products');
    Route::get('comments','MainController@comments');
    Route::get('about-us','MainController@about_us');
    Route::get('about-restaurant','MainController@about_restaurant');
    Route::post('restaurant-register','RestaurantController@register');
    Route::post('restaurant-login','RestaurantController@login');
    Route::post('restaurant-reset-password', 'RestaurantController@reset_password');
    Route::post('restaurant-forgot-password', 'RestaurantController@forgot_password');


    Route::post('client-register','ClientController@register');
    Route::post('client-login','ClientController@login');
    Route::post('client-forgot-password', 'ClientController@forgot_password');
Route::post('client-reset-password','ClientController@reset_password');

    Route::group(['middleware' => 'auth:restaurant'], function () {
     Route::post('restaurant-profile','RestaurantController@profile');
     Route::post('restaurant-add-product','RestaurantFoodController@add_product');
        Route::post('restaurant-update-product/{id}','RestaurantFoodController@update_product');
        Route::get('restaurant-product/{id}','RestaurantFoodController@product');
Route::get('restaurant-products','RestaurantFoodController@products');

        Route::post('restaurant-add-offer','RestaurantOfferController@addOffer');
        Route::post('restaurant-update-offer/{id}','RestaurantOfferController@updateOffer');
        Route::get('restaurant-offers','RestaurantOfferController@offers');

        Route::post('register-token-restaurant','RestaurantController@registerTokenRestaurant');
        Route::post('remove-token-restaurant','RestaurantController@removeTokenRestaurant');

        Route::get('restaurant-commission','CommissionController@commission');
    });


    Route::group(['middleware' => 'auth:client'],function (){
        Route::post('client-profile','ClientController@profile');
        Route::post('add-comment','ClientController@addComment');
        Route::post('contact-us','ClientController@contactUs');
        Route::get('restaurant-information','SettingController@restaurantInformation');
        Route::post('register-token','ClientController@registerToken');
        Route::post('remove-token','ClientController@removeToken');
        Route::post('new-order','ClientOrderController@newOrder');

    });

});
