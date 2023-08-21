<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StaffPermissionController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\JobController; 
use App\Http\Controllers\GoogleController; 
use App\Http\Controllers\CustomLoginController; 
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

Auth::routes(['verify' => true]);
Route::name('user.')->prefix('user')->group(function(){
    Route::get('/dashboard',[HomeController::class, 'dashboard'])->name('dashboard');
    
});



// Site Routes
Route::get('/', [SiteController::class, 'index']);
Route::get('/login', [SiteController::class, 'login']);


// Hiring Maps
Route::name('admin.')->prefix('admin')->group(function(){
    Route::get('/login',[LoginController::class, 'login'])->name('login');
    Route::post('/login-process',[LoginController::class, 'login_process'])->name('login_process');
    Route::post('/logout',[LoginController::class, 'logout'])->name('logout');
});


Route::name('admin.')->prefix('admin')->namespace('App\Http\Controllers\Admin')->middleware('admin')->group(function(){
    Route::get('/dashboard','AdminController@dashboard')->name('dashboard');
    Route::get('/profile','AdminController@profile')->name('profile');
    Route::post('/updateuserprofile','AdminController@updateuserprofile');
    Route::post('/updateusersecurity','AdminController@updateusersecurity');


    Route::name('users.')->prefix('users')->group(function(){
        Route::get('/','AdminController@allusers');
        Route::get('/deleteuser/{id}','AdminController@deleteuser');
        Route::get('/addnewuser','AdminController@addnewuser');
        Route::get('/edituser/{id}','AdminController@edituser');
        Route::post('/addnewuser','AdminController@addnewusers');
        Route::post('/edituser','AdminController@updateusers');

    });


    Route::name('videos.')->prefix('videos')->group(function(){
        Route::get('/','AdminController@allvideos');
        Route::post('/create','AdminController@createvideo');
        Route::post('/delete','AdminController@deletevideo');
        Route::get('/edit/{id}','AdminController@editvideo');
        Route::post('/update','AdminController@updatevideo');
        Route::get('/search','AdminController@searchvideo');
    });

});