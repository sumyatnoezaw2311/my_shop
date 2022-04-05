<?php

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

Auth::routes();

Route::group(['middleware' => ['auth', 'banedUser']], function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('admin')->middleware('adminOnly')->group(function (){
        Route::get('/user-manager','UserManagerController@users')->name('user-manager.users');
        Route::post('/make-admin','UserManagerController@makeAdmin')->name('user-manager.make-admin');
        Route::post('/ban-user','UserManagerController@banUser')->name('user-manager.ban-user');
        Route::post('/restore-user','UserManagerController@restoreUser')->name('user-manager.restore-user');
        Route::post('/change-password','UserManagerController@changeUserPassword')->name('user-manager.change-password');
    });


    Route::prefix('profile')->group(function(){
        // Main Frame Route
        Route::get('/','ProfileController@profile')->name('profile');
        Route::get('/edit-photo','ProfileController@editPhoto')->name('profile.edit.photo');
        Route::get('/edit-password','ProfileController@editPassword')->name('profile.edit.password');
        Route::get('/edit-name-and-email','ProfileController@editNameEmail')->name('profile.edit.name.email');
        Route::post('/change-password','ProfileController@changePassword')->name('profile.changePassword');
        Route::post('/change-information','ProfileController@changeInformation')->name('profile.changeInformation');
        Route::post('/change-email','ProfileController@changeEmail')->name('profile.changeEmail');
        Route::post('/change-photo','ProfileController@changePhoto')->name('profile.changePhoto');
        Route::post('/update-info','ProfileController@updateInfo')->name('profile.updateInfo');
    });
});



