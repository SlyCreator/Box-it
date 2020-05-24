<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\PackageController;
use App\Http\Controllers\Admin\InvoiceController;
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
        Route::get('track/{trackCode}',[PackageController::class,'track']);
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
                            Route::delete('/',[OrderController::class,'destroy']);
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
                Route::group(['prefix'=>'invoice'],function(){
                    Route::get('/',[InvoiceController::class,'fetchAll']);
                    Route::post('/',[InvoiceController::class,'generateInvoice']);
                    Route::group(['prefix'=>'{invoiceId}'],function (){
                        Route::post('/paid',[InvoiceController::class,'markAsPaid']);
//                        Route::get('/',[InvoiceController::class,'show']);
//                        Route::get('/',[InvoiceController::class,'update']);
                        Route::delete('/',[InvoiceController::class,'destroy']);
                    });
                });

            Route::group(['prefix'=>'package'],function(){
                Route::get('/',[PackageController::class,'fetchAll']);
                Route::post('/',[PackageController::class,'AddLocation']);
                Route::group(['prefix'=>'{packageId}'],function (){
                    Route::get('/',[PackageController::class,'show']);
                    Route::post('/markDelivered',[PackageController::class,'isDelivered']);
                    Route::post('/',[PackageController::class,'updateLocation']);
                    Route::delete('/',[PackageController::class,'destroy']);
                });
            });
        });
});

/**
**
*1)user can track order  .....G ===> done
 * 2)user can order for service........B =====> done
 * 3)user can file a complain
 * 4)Admin can complete the invoice filing by adding weight ....C ... D ==> done ==> done
 * 5)Admin can make as paid ....E ==> done
 * 6)Admin can Crud package location update .....F  =====>done
 * 7)Admin can make Package or order as delivered  ....H
 * 8)Admin can crud serviceType ......A....=======> done
*/
