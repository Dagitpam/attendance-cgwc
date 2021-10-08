<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function(){
	
	Route::get('logout', 'AuthController@logout');

	Route::get('profile', 'AuthController@profile');
	Route::post('change-password', 'AuthController@changePassword');
	Route::post('update-profile', 'AuthController@updateProfile');

	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function(){
		Route::get('/users', 'UserController@list');
		Route::post('/user/create', 'UserController@store');
		Route::get('/user/{id}', 'UserController@profile');
		Route::get('/user/delete/{id}', 'UserController@delete');
		Route::post('/user/change-role/{id}', 'UserController@changeRole');
	});

	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		Route::get('/roles', 'RolesController@list');
		Route::post('/role/create', 'RolesController@store');
		Route::get('/role/{id}', 'RolesController@show');
		Route::get('/role/delete/{id}', 'RolesController@delete');
		Route::post('/role/change-permission/{id}', 'RolesController@changePermissions');
	});


	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function(){
		Route::get('/permissions', 'PermissionController@list');
		Route::post('/permission/create', 'PermissionController@store');
		Route::get('/permission/{id}', 'PermissionController@show');
		Route::get('/permission/delete/{id}', 'PermissionController@delete');
	});
	
});
