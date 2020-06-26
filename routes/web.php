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
	if (!Auth::check()) {
    	return view('welcome');
	}
	return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware'=>'auth'], function(){
	Route::get('/home', 'HomeController@index')->name('home');
});


Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
	
	Route::namespace('Auth')->group(function(){
	    //Login Routes
	    Route::get('/login','LoginController@showLoginForm')->name('login');
	    Route::post('/login','LoginController@login');
	    Route::post('/logout','LoginController@logout')->name('logout');

	    //Forgot Password Routes
	    Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
	    Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

	    //Reset Password Routes
	    Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
	    Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');

	});

	Route::group(['middleware'=>'auth:admin'], function(){
		Route::get('/dashboard','HomeController@index')->name('home');
	});
		
});