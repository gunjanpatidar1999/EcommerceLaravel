<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'api'],function($router){

     Route::post('/register',[AccountController::class,'register']);

      Route::post('/login',[AccountController::class,'login']);

     Route::post('/index',[AccountController::class,'index']);

      Route::post('/profile',[AccountController::class,'profile']);

      Route::post('/getuser',[AccountController::class,'getuser']);

     Route::post('/refresh',[AccountController::class,'referesh']);
     
     Route::post('/logout',[AccountController::class,'logout']);

     Route::post('/contact',[AccountController::class,'contact']);

     Route::get('/category',[AccountController::class,'category']);

      Route::get('/categories/{id}',[AccountController::class,'categories']);

    // Route::get('/product?category={id}',[AccountController::class,'categories']);
     

     Route::get('/product',[AccountController::class,'product']);

     Route::get('/singleproduct/{id}',[AccountController::class,'singleproduct']);
     
     Route::post('/order',[AccountController::class,'order']);

     Route::post('/address',[AccountController::class,'address']);

     
     Route::post('/changepassword',[AccountController::class,'changepassword']);

     Route::get('/coupon',[AccountController::class,'coupon']);

    //  Route::post('/profile',[dummycontroller::class,'profile']);
    // Route::post('/index',[JWTController::class,'index']);
  });