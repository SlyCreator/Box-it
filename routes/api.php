<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\OrderController;
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

        Route::post('order',[OrderController::class,'store']);
        Route::get('track/{trackCode}',[OrderController::class,'track']);
        Route::post('complain',[OrderController::class,'complain']);


        Route::post('/register',[AuthController::class,'register']);
        Route::post('/login',[AuthController::class,'login']);

        Route::group(['prefix'=>'Admin','middleware'=>'auth:api'],function (){

                Route::group(['prefix'=>'order'],function(){
                        Route::get('/',[OrderController::class,'index']);
                        Route::post('/',[OrderController::class,'store']);
                        Route::group(['prefix'=>'{OrderId}'],function (){
                            Route::get('/',[OrderController::class,'show']);
                            Route::post('/',[OrderController::class,'update']);
                            Route::get('/',[OrderController::class,'destroy']);
                        });
                });
                Route::group(['prefix'=>'serviceType'],function(){
                        Route::get('/',[ServiceTypeController::class,'index'])->withoutMiddleware('auth:api');
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
*1)user can track order  .....G
 * 2)user can order for service........B
 * 3)user can file a complain
 * 4)Admin can complete the invoice filing by adding weight ....C ... D
 * 5)Admin can make as paid ....E
 * 6)Admin can Crud package location update .....F
 * 7)Admin can make Package or order as delivered  ....H
 * 8)Admin can crud serviceType ......A....done
*/
