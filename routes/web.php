<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StaffPermissionController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\AuthUserController;
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

Auth::routes();
Route::get('/home',[HomeController::class, 'dashboard'])->name('home');
Route::get('/home',[HomeController::class, 'dashboard'])->name('userprofile');




Route::name('user.')->prefix('')->group(function(){
    Route::get('/dashboard',[HomeController::class, 'dashboard'])->name('home');
    Route::get('/videos',[HomeController::class, 'videos'])->name('videos');
    Route::get('/quizes',[HomeController::class, 'quizes'])->name('quizes');
    Route::get('/profile',[HomeController::class, 'profile'])->name('profile');
    Route::POST('/updateuserprofile', [HomeController::class, 'updateuserprofile']);
    Route::get('/securitysettings',[HomeController::class, 'securitysettings'])->name('securitysettings');
    Route::POST('/updateusersecurity', [HomeController::class, 'updateusersecurity']);
    
    Route::get('/video/{id}',[HomeController::class, 'videodetail']);
    Route::get('/category/{id}',[HomeController::class, 'categorydetail']);
    Route::get('/slideshows',[HomeController::class, 'slideshows'])->name('slideshows');
    Route::get('/slideshow/{id}',[HomeController::class, 'slideshowdetail']);
    Route::get('/slidecategory/{id}',[HomeController::class, 'slidecategory']);
    Route::get('/quiz/{id}',[HomeController::class, 'quizdetail']);
    Route::get('/quiz/getuserquiz/{id}',[HomeController::class, 'getuserquiz']);
    Route::get('/quiz/savequiz/{id}/{value}/{question}',[HomeController::class, 'savequiz']);
    Route::get('/clicknotification/{id}',[HomeController::class, 'clicknotification']);
    
});
Route::POST('/userlogin', [AuthUserController::class, 'login'])->name('user.login');


// Site Routes
Route::get('/', [SiteController::class, 'index']);


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
        Route::post('/create','AdminController@createuser');
        Route::get('/edit/{id}','AdminController@edituser');
        Route::post('/delete','AdminController@deleteuser');
        Route::post('/edituser','AdminController@updateusers');
    });


    Route::name('videos.')->prefix('videos')->group(function(){
        Route::get('/','AdminController@allvideos');
        Route::post('/create','AdminController@createvideo');
        Route::post('/delete','AdminController@deletevideo');
        Route::get('/edit/{id}','AdminController@editvideo');
        Route::post('/update','AdminController@updatevideo');
        Route::get('/search','AdminController@searchvideo');
        Route::post('/createcategory','AdminController@createcategory');
        Route::post('/deletecategory','AdminController@deletecategory');
        Route::post('/updatecategory','AdminController@updatecategory');
        
    });



    Route::name('slideshows.')->prefix('slideshows')->group(function(){
        Route::get('/','AdminController@allslideshows');
        Route::post('/create','AdminController@createslideshow');
        Route::post('/delete','AdminController@deleteslideshow');
        Route::get('/edit/{id}','AdminController@editslideshow');
        Route::post('/update','AdminController@updateslideshow');
        Route::get('/search','AdminController@searchslideshow');
    });


    Route::name('quizzes.')->prefix('quizzes')->group(function(){
        Route::get('/','AdminController@allquizzes');
        Route::get('/addnew','AdminController@addnewquiz');
        Route::post('/createquiz','AdminController@createquiz');
        Route::get('/addquestion/{id}','AdminController@addquestion');
        Route::post('/addquestion','AdminController@createquestion');
        Route::post('/updatequiz','AdminController@updatequiz');
        Route::post('/delete','AdminController@deletequiz');
        Route::get('/viewquiz/{id}','AdminController@viewquiz');
    });
});