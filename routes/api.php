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

Route::group(['middleware' => ['json.response']], function () {

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    // public routes
    Route::post('/login', 'Api\AuthController@login')->name('login.api');
    Route::post('/register', 'Api\AuthController@register')->name('register.api');

    Route::get('/categories', 'Api\CategoriesController@index');

    Route::get('/menu-items/popular', 'Api\MenuItemController@popular');
    Route::get('/menu-items/{category}', 'Api\MenuItemController@index');
    Route::get('/menu-items/{category}/{menu_item}', 'Api\MenuItemController@show');

    // private routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'Api\AuthController@logout')->name('logout');
        
        Route::post('/categories', 'Api\CategoriesController@store');

        Route::get('/cart-items', 'Api\CartItemsController@index');
        Route::post('/cart-items', 'Api\CartItemsController@store');

        Route::post('/checkout', 'Api\OrdersController@store');
    });
});
