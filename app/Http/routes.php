<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ProductsController@catalog');

Route::auth();

Route::get('products', ['as' => 'products', 'uses' => 'ProductsController@catalog']);

Route::get('products/{slug}', ['as' => 'product.detail', 'uses' => 'ProductsController@detail']);


/**
 * Cart routes
 */

Route::get('cart', ['as' => 'cart', 'uses' => 'CartController@summary']);

Route::post('cart/add', ['as' => 'cart.add', 'uses' => 'CartController@add']);

Route::post('cart/update', ['as' => 'cart.update', 'uses' => 'CartController@update']);

Route::get('cart/{skuId}/delete', ['as' => 'cart.delete', 'uses' => 'CartController@delete']);

/**
 * Checkout routes
 */

Route::group(['prefix' => 'checkout','middleware' => ['auth']], function (){

    Route::get('/', ['as' => 'checkout', 'uses' => 'CheckoutController@index']);

    Route::post('/complete', ['as' => 'checkout.complete', 'uses' => 'CheckoutController@complete']);

    Route::get('/{order}/confirmation', ['as' => 'checkout.confirmation', 'uses' => 'CheckoutController@confirmation']);

});

/**
 * Admin URLS
 */

Route::group(['prefix' => 'admin','middleware' => ['user.admin']], function (){

    Route::get('/', ['as' => 'admin', 'uses' => 'Admin\IndexController@dashboard']);

    Route::resource('/products','Admin\ProductsController');

    Route::get('/products/{id}/images', ['as' => 'admin.products.images',
        'uses' => 'Admin\ImagesController@show']);
    
    Route::post('/products/{id}/images', ['as' => 'admin.products.images.save',
        'uses' => 'Admin\ImagesController@save']);
    
    Route::get('/products/{productId}/images/{imageId}/delete', ['as' => 'admin.products.images.delete',
        'uses' => 'Admin\ImagesController@delete']);

    Route::get('/product/json/{id}', ['as' => 'admin.products.json',
        'uses' => 'Admin\ProductsController@json']);
});