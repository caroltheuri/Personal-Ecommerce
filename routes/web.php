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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/layout', 'HomeController@layout')->name('layout');

// Route::get('/products', 'ProductController@index');
//users routes
Route::get('/users', 'CategoryController@viewUsers');
Route::delete('/users/{id}', 'CategoryController@deleteUsers');

//categories routes
Route::get('/categories/create', 'CategoryController@create');
Route::post('/categories', 'CategoryController@store');
Route::get('/categories', 'CategoryController@index');
Route::get('/categories/edit/{id}', 'CategoryController@edit');
Route::Patch('/categories/{id}', 'CategoryController@update');
Route::delete('/categories/{id}', 'CategoryController@destroy');

//passes the user_types to register.blade.php
Route::get('/auth/create', 'RegisterController@showRegistrationForm');

//Features routes
Route::get('/features/create', 'FeatureController@create');
Route::post('/features', 'FeatureController@store');
Route::get('/features', 'FeatureController@index');
Route::get('/features/edit/{id}', 'FeatureController@edit');
Route::Patch('/features/{id}', 'FeatureController@update');
Route::delete('/features/{id}', 'FeatureController@destroy');

//Product routes
Route::get('/products/create', 'ProductController@create');
Route::get('/buyers', 'ProductController@showProductstoBuyers');
Route::get('/buyers/showJson', 'ProductController@showProductsJSON');
Route::get('/buyers/{productfeatureid}', 'ProductController@totalFeaturePrice');
Route::post('/products', 'ProductController@store');
Route::get('/products', 'ProductController@index');
Route::get('/products/edit/{id}', 'ProductController@edit');
Route::Patch('/products/{id}', 'ProductController@update');
Route::delete('/products/{id}', 'ProductController@destroy');

//ProductFeature routes
Route::get('/productfeatures/{id}', 'ProductFeatureController@showProductFeatures');
Route::post('/productfeatures', 'ProductFeatureController@store');
Route::Patch('/productfeatures/{id}', 'ProductFeatureController@update');
Route::delete('/productfeatures/{id}', 'ProductFeatureController@destroy');

//product_image routes
Route::get('/productimages/{id}', 'ProductImageController@passProduct');
Route::post('/productimages', 'ProductImageController@store');
Route::delete('/productimages/{id}', 'ProductImageController@destroy');

//order routes
Route::post('/orders/{id}', 'OrderController@store');
Route::get('/orderitems', 'OrderItemController@index');

//register businesses
Route::get('/registerbusinesses', 'RegisterBusinessController@index');
Route::post('/registerbusinessesindatabase', 'RegisterBusinessController@store');
Route::get('/webhook', 'RegisterBusinessController@webhook');
Route::post('/orders', 'OrderController@store');
Route::get('/orders', 'OrderController@index');
Route::get('/orderitembuyer/{orderid}', 'OrderController@indexBuyer');
Route::get('/orderbuyer', 'OrderController@orderBuyer');
// Route::get('/orders/{id}/{user_id}/{orderitem_id}/{product_id}', 'OrderController@show');
Route::get('/orders/{id}', 'OrderController@show');
Route::get('/orderitems', 'OrderItemController@index');
Route::get('/orderitemscart', 'OrderItemController@cart');
Route::Patch('/orderitems/{id}', 'OrderItemController@update');
Route::Patch('/orders/{id}', 'OrderController@update');
Route::Patch('/completeorders/{id}/{seller_id}', 'OrderController@completeOrder');
Route::delete('/orderitems/{id}', 'OrderItemController@destroy');
// Route::delete('/orders/{id}', 'OrderItemController@destroy');

//tambuzi routes
Route::post('/saveProfile', 'TambuziController@storeProfile');
Route::get('/getProfile', 'TambuziController@getProfiles');
Route::post('/saveBlock', 'TambuziController@storeBlocks');
Route::get('/saveFlowerTypes', 'TambuziController@getFlowerTypes');
Route::post('/savePlanting', 'TambuziController@storePlanting');
Route::post('/savePicking', 'TambuziController@storePicking');
Route::post('/saveBouquet', 'TambuziController@storeBouquet');
Route::post('/saveBouquetPick', 'TambuziController@storeBouquetPick');
Route::post('/saveBoxing', 'TambuziController@storeBoxing');
Route::post('/saveShipment', 'TambuziController@storeShipment');

Route::get('/getBouquetDetails', 'TambuziController@getBouquetDetails');
Route::get('/getShipments', 'TambuziController@getShipments');
Route::get('/getBoxes', 'TambuziController@getBoxNumbers');