<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\bannercontroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

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

//dashboard
// Route::get('/home',function(){
//     return view('dashboard');
// });

Route::get('login',[HomeController::class,'index'])->name('login'); //named route


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin', function () {
        return view('dashboard');
      })->name('dashboard');

      // Route to see Usermanagement
      Route::get('/usermanagement',[UserManagementController::class,'ShowUser']);

      // Route To create user
      Route::get('/createuser',[UserManagementController::class,'CreateUser']);

     // Route to post user data
     Route::post('/postuser',[UserManagementController::class,'PostUser']);

     //Route To Delete User
     Route::get('/deleteuser/{id}',[UserManagementController::class,'DeleteUser']);

     //Route To Edit User
     Route::get('/edituser/{id}',[UserManagementController::class,'EditUser']);

     //Route To Update User
     Route::post('/updateuser/{id}',[UserManagementController::class,'UpdateUser']);


     //Banner Management
     //Route To Add banner
     Route::get('/addbanner',[bannercontroller::class,'AddBanner']);

     //Route to post banner data
     Route::post('/postbanner',[bannercontroller::class,'PostBanner']);


     //Route to Show Banner data
     Route::get('/showbanner',[bannercontroller::class,'ShowBanner']);

     //Route to show banner images
     Route::get('/displayBannerImages/{id}',[bannercontroller::class,'ShowBannerImages']);

     //Route To delete Banner
     Route::get('/deletebanner/{id}',[bannercontroller::class,'DeleteBanner']);

     //Route To Edit Banner
     Route::get('/editbanner/{id}',[bannercontroller::class,'EditBanner']);

     //Route To Update Banner
     Route::post('/updatebanner/{id}',[bannercontroller::class,'UpdateBanner']);


     //Category Section
     //Route To Add Category
     Route::get('/addcategory',[CategoryController::class,'AddCategory']);

     //Route to post Category
     Route::post('/postcategory',[CategoryController::class,'PostCategory']);

     //Routr to show category
     Route::get('/showcategory',[CategoryController::class,'ShowCategory']);

     //Route to delete Category
     Route::get('/deletecategory/{id}',[CategoryController::class,'DeleteCategory']);

     //Routr to edit Category
     Route::get('/editcategory/{id}',[CategoryController::class,'EditCategory']);

     //Route to update Category
     Route::post('/updatecategory/{id}',[CategoryController::class,'UpdateCategory']);

     //Route to Add Product
     Route::get('/addproduct',[CategoryController::class,'AddProduct']);

     //Route To Post Product
     Route::post('/postproduct',[CategoryController::class,'PostProduct']);

     //Route to show Product
     Route::get('/showproduct',[CategoryController::class,'ShowProduct']);

     //Routr to display product images
     Route::get('/displayProductImages/{id}',[CategoryController::class,'ShowProductImages']);

     //Routr to delete product
     Route::get('/deleteproduct/{id}',[CategoryController::class,'DeleteProduct']);

     //Route to edit Product
     Route::get('/editproduct/{id}',[CategoryController::class,'EditProduct']);

     //Route To Update Product
     Route::post('/updateproduct/{id}',[CategoryController::class,'UpdateProduct']);


     //Coupoon Management
     //Route to add coupon
     Route::get('/addcoupon',[CouponController::class,'AddCoupon']);

     //Routr to post coupon
     Route::post('/postcoupon',[CouponController::class,'PostCoupon']);

     //Route to show Coupon
     Route::get('/showcoupon',[CouponController::class,'ShowCoupon']);

     //Routr to delete coupon
     Route::get('deletecoupon/{id}',[CouponController::class,'DeleteCoupon']);

     //Route to edit coupon
     Route::get('/editcoupon/{id}',[CouponController::class,'EditCoupon']);

     //Route to update coupon
     Route::post('/updatecoupon/{id}',[CouponController::class,'UpdateCoupon']);

     //Route for contact us
     Route::get('/showcontact',[UserManagementController::class,'ContactUs']);

     Route::get('/products',[AccountController::class,'product']);
     
     //show order deatils
     Route::get('/showorder',[CategoryController::class,'ShowOrderDeatils']);

  });