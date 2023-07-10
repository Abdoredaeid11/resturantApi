<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\BreakfastController;




//////

    ///////////////////////

route::get('breakfast',[BreakfastController::class,'list']);
route::get('breakfast/en',[BreakfastController::class,'list_en']);
route::get('breakfast/ar',[BreakfastController::class,'list_ar']);
route::post('breakfast/rate/{id}',[BreakfastController::class,'addrate']);

Route::group(['middleware' => ['api','checkPassword','checkAdminToken:admin-api'], 'namespace' => 'Api'], function () {
    route::post('admin',[BreakfastController::class,'list']);
});

route::post('get-breakfast-byid',[BreakfastController::class,'getbreakfastbyid']);


Route::group(['prefix' => 'admin',],function (){
    route::post('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout']) -> middleware(['auth.guard:admin-api']);
});

Route::group(['prefix' => 'user',],function (){
    route::post('register',[AuthController::class,'register']);

    route::post('login',[AuthController::class,'userlogin']);
    Route::post('logout',[AuthController::class,'userlogout']) -> middleware(['auth.guard:user-api']);
});

Route::group(['prefix' => 'user','middleware'=>'auth.guard:user-api'],function (){
    route::post('profile',function(){
return Auth::user();

    });


});

route::post('login',[AuthController::class,'login']);



    
    
