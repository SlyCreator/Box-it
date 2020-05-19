<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix'=>'v1'],function (){

        Route::group(['namespace'=>'Auth'],function (){
                Route::post('/register','AuthController@register');
                Route::post('/login','AuthController@login');
        });
        Route::group(['namespace' => 'User'],function(){

        });
        Route::group(['prefix'=>'Admin','namespace'=>'Admin','middleware'=>'auth:api'],function (){
                Route::post('order','OrderController@store');
                Route::get('track/{trackCode}','OrderController@track');
                Route::post('complain','OrderController@complain');
        });
});
