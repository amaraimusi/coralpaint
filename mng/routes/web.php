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
//■■■□□□■■■□□□
// Route::get('/', function () {
// 	return view('welcome');
// });

	Route::get('/', 'DashboardController@index');
	
	
	Route::post('ajax_login_with_cake/login_check', 'AjaxLoginWithCakeController@login_check');
	Route::get('ajax_login_with_cake/login_rap', 'AjaxLoginWithCakeController@login_rap');
	Route::get('ajax_login_with_cake/logout', 'AjaxLoginWithCakeController@logout');
	
	Route::get('dashboard', 'DashboardController@index');
	
	// Neko
	Route::get('neko', 'NekoController@index');
	Route::post('neko/ajax_reg', 'NekoController@ajax_reg');
	Route::post('neko/ajax_delete', 'NekoController@ajax_delete');
	Route::post('neko/auto_save', 'NekoController@auto_save');
	Route::post('neko/ajax_pwms', 'NekoController@ajax_pwms');
	Route::get('neko/csv_download', 'NekoController@csv_download');
	Route::post('neko/bulk_reg', 'NekoController@bulk_reg');
	
	// Content
	Route::get('content', 'ContentController@index');
	Route::post('content/ajax_reg', 'ContentController@ajax_reg');
	Route::post('content/ajax_delete', 'ContentController@ajax_delete');
	Route::post('content/auto_save', 'ContentController@auto_save');
	Route::post('content/ajax_pwms', 'ContentController@ajax_pwms');
	Route::get('content/csv_download', 'ContentController@csv_download');
	Route::post('content/bulk_reg', 'ContentController@bulk_reg');
	
	// Page
	Route::get('page', 'PageController@index');
	Route::post('page/ajax_reg', 'PageController@ajax_reg');
	Route::post('page/ajax_delete', 'PageController@ajax_delete');
	Route::post('page/auto_save', 'PageController@auto_save');
	Route::post('page/ajax_pwms', 'PageController@ajax_pwms');
	Route::get('page/csv_download', 'PageController@csv_download');
	Route::post('page/bulk_reg', 'PageController@bulk_reg');
	
	// Img
	Route::get('a_img', 'AImgController@index');
	Route::post('a_img/ajax_reg', 'AImgController@ajax_reg');
	Route::post('a_img/ajax_delete', 'AImgController@ajax_delete');
	Route::post('a_img/auto_save', 'AImgController@auto_save');
	Route::post('a_img/ajax_pwms', 'AImgController@ajax_pwms');
	Route::get('a_img/csv_download', 'AImgController@csv_download');
	Route::post('a_img/bulk_reg', 'AImgController@bulk_reg');
	
	// UserMng
	Route::get('user_mng', 'UserMngController@index');
	Route::post('user_mng/ajax_reg', 'UserMngController@ajax_reg');
	Route::post('user_mng/ajax_delete', 'UserMngController@ajax_delete');
	Route::post('user_mng/auto_save', 'UserMngController@auto_save');
	Route::post('user_mng/ajax_pwms', 'UserMngController@ajax_pwms');
	Route::get('user_mng/csv_download', 'UserMngController@csv_download');
	Route::post('user_mng/bulk_reg', 'UserMngController@bulk_reg');
	
	
	Route::get('/home', 'HomeController@index')->name('welcome');
	//Route::get('/home', 'HomeController@neko')->name('neko');
	Auth::routes();