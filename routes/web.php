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
Route::group(['middleware'=>['web']],function() {

        Route::get('/', [
            'uses' => 'frontController@index',
            'as' => 'index'
        ]);

        //Route::group('')
        Route::resource('products', 'ProductController');

        Route::get('/product/{id}',[
            'uses'=>'frontController@singleProduct',
            'as'=>'product.single'
        ]);

        Route::post('/cart/add',[
            'uses'=>'shoppingController@add_to_cart',
            'as'=>'cart.add'
        ]);

        Route::get('/cart/rapid/add/{id}',[
            'uses'=>'shoppingController@rapid_add',
            'as'=>'cart.rapid.add'
        ]);

        Route::get('/cart',[
            'uses'=>'shoppingController@cart',
            'as'=>'cart'
        ]);

        Route::get('/cart/delete/{id}',[
            'uses'=>'shoppingController@cart_delete',
            'as'=>'cart.delete'
        ]);

        Route::get('/cart/increment/{id}/{qty}',[
            'uses'=>'shoppingController@increment',
            'as'=>'cart.increment'
        ]);
        Route::get('/cart/delete/{id}/{qty}',[
            'uses'=>'shoppingController@decrement',
            'as'=>'cart.decrement'
        ]);

        Route::get('/cart/checkout',[
            'uses'=>'checkOutController@index',
            'as'=>'cart.checkout'
        ]);

        Route::post('/cart/checkout',[
            'uses'=>'checkOutController@pay',
            'as'=>'cart.checkout'
        ]);


    Route::get('api/contact', 'ProductController@table')->name('api.contact');


        Auth::routes();

        Route::get('/home', 'HomeController@index')->name('home');
});