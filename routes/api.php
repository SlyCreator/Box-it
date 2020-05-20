<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceTypeController;
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
        Route::group(['prefix'=>'Admin','middleware'=>'auth:api'],function (){
                Route::post('order','OrderController@store');
                Route::get('track/{trackCode}','OrderController@track');
                Route::post('complain','OrderController@complain');

                Route::group(['prefix'=>'serviceType'],function(){
                        Route::get('/',[ServiceTypeController::class,'index']);
                        Route::post('/',[ServiceTypeController::class,'store']);
                        Route::group(['prefix'=>'{serviceTypeId}'],function (){
                                Route::get('/',[ServiceTypeController::class,'show']);
                                Route::post('/',[ServiceTypeController::class,'update']);
                                Route::delete('/',[ServiceTypeController::class,'destroy']);
                        });
                });
                Route::group(['prefix'=>'Invoice'],function(){
                    Route::get('/',[InvoiceController::class,'index']);
                    Route::post('/',[InvoiceController::class,'store']);
                    Route::group(['prefix'=>'{invoiceId}'],function (){
                        Route::get('/',[InvoiceController::class,'show']);
                        Route::get('/',[InvoiceController::class,'update']);
                        Route::get('/',[InvoiceController::class,'destroy']);
                    });
                });
        });
});

/**
**
*1)user can track order
 * 2)user can order for service
 * 3)user can file a complain
 * 4)Admin can complete the invoice filing by adding weight
 * 5)Admin can make as paid
 * 6)Admin can Crud package location update
 * 7)Admin can make Package or order as delivered
 * 8)Admin can crud serviceType
*/
