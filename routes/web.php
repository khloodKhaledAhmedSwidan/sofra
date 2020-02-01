<?php

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


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => ['auth:web', 'auto-check-permission']], function () {
        Route::get('home', 'HomeController@index')->name('admin_home');
        Route::resource('cities', 'CityController');
        Route::resource('regions', 'RegionController');
        Route::resource('categories', 'CategoryController');
        Route::resource('settings', 'SettingController')->except(['destroy', 'show', 'create', 'store']);
        Route::resource('contacts', 'ContactController')->except(['create', 'store', 'edit', 'update']);
        Route::resource('offers', 'OfferController')->except(['create', 'store', 'edit', 'update']);
        Route::resource('clients', 'ClientController')->except(['create', 'store', 'edit', 'update', 'show']);
        Route::get('clients/{id}/is_active', 'ClientController@isActive')->name('clients.active');
        Route::resource('restaurants', 'RestaurantController')->except(['create', 'store', 'edit', 'update']);
        Route::get('restaurants/{id}/is_active', 'RestaurantController@isActive')->name('restaurants.active');
        Route::resource('orders', 'OrderController')->except(['create', 'store', 'edit', 'update']);
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::get('change-password-form', 'UserController@passForm')->name('pass.form');
        Route::post('change-password', 'UserController@changePass')->name('pass.change');
        Route::resource('payments', 'PaymentController')->except(['create', 'store', 'show', 'edit', 'update']);


    });
});
Route::group(['prefix' => 'sofra', 'namespace' => 'Web'], function () {
    Route::get('client-register', 'AuthController@registerFormClient')->name('register.formClient');
    Route::post('client-register', 'AuthController@registerClient')->name('register.Client');
    Route::get('login', 'AuthController@loginPage')->name('WebLogin.page');
    Route::post('login', 'AuthController@login')->name('WebLogin');
    Route::get('restaurant-register', 'AuthController@registerFormRestaurant')->name('register.formRestaurant');
    Route::post('restaurant-register', 'AuthController@registerRestaurant')->name('register.Restaurant');
    Route::get('restaurant-login', 'AuthController@loginPageRestaurant')->name('Login.pageRestaurant');
    Route::post('restaurant-login', 'AuthController@restaurantlogin')->name('restaurant.login');
    Route::get('web-home', 'MainController@index')->name('main.page');
    Route::get('products/{id}', 'MainController@products')->name('product.page');
    Route::get('product/{id}', 'MainController@product')->name('product.details');
    Route::get('offers', 'ClientOfferController@offers');
    Route::group(['middleware' => 'auth:site_client'], function () {
        Route::get('cart', 'CartController@list')->name('list.cart');
        Route::get('add-to-cart', 'CartController@addToCart');
        Route::get('delete-item-cart/{id}', 'CartController@removeFromCart')->name('remove.cart');
//        Route::delete('delete-item-cart', 'CartController@removeFromCart')->name('remove.cart');
        //Route::delete('delete-all-cart', 'CartController@removeAllCart')->name('removeAll.cart');
        Route::get('delete-all-cart', 'CartController@removeAllCart')->name('remove.allCart');


        Route::get('send-orders','OrderController@sendOrders')->name('send.AllCart');


        Route::post('product/{id}/comment', 'MainController@comment');
        Route::get('client-profile', 'AuthController@clientProfilePage')->name('client.profilePage');
        Route::PATCH('client-profile', 'AuthController@clientProfile')->name('profile.page');
        Route::get('contact-us', 'MainController@contactUsPage')->name('contactUs.form');
        Route::post('contact-us', 'MainController@contactUs')->name('contactUs');
        Route::get('my-order', 'OrderController@myOrderPage')->name('order.page');
        Route::get('client/order/{id}/delivered', 'OrderController@delivered');
        Route::get('client/order/{id}/rejected', 'OrderController@rejected');
        Route::get('client/previous/orders', 'OrderController@prevOrders')->name('previous.orders');


        Route::post('send/orders', 'OrderController@addOrders')->name('send.orders');
    });


    Route::group(['middleware' => 'auth:site_restaurant'], function () {
        Route::resource('restaurant-offers', 'OfferController');
        Route::resource('restaurant-products', 'ProductController');
        Route::get('restaurant-profile', 'AuthController@restaurantProfilePage')->name('restaurant.profilePage');
        Route::PATCH('restaurant-profile', 'AuthController@restaurantProfile')->name('restaurant.profile');
        Route::get('orders-new', 'RestaurantOrderController@newOrder')->name('restaurant.newOrder');
        Route::get('order/{id}/accepted', 'RestaurantOrderController@accepted');
        Route::get('order/{id}/rejected', 'RestaurantOrderController@rejected');
        Route::get('previous-orders', 'RestaurantOrderController@pervOrders')->name('prev.orders');
        Route::get('current-orders', 'RestaurantOrderController@currentOrders')->name('current.orders');

    });


});

Route::post('client-logout', function () {
//    auth('site_client')->logout();
    if (auth('site_client')->user()) {
        session()->forget('restaurant');
        session()->forget('cart');
        auth('site_client')->logout();


    }
    if (auth('site_restaurant')->user()) {
        auth('site_restaurant')->logout();

    }
    return redirect()->route('main.page');
});
