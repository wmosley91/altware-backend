<?php

use Illuminate\Http\Request;

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
Route::post('addCategory', 'CategoryController@store');
Route::post('updateCategory/{id}', 'CategoryController@update');
Route::post('deleteCategory/{id}', 'CategoryController@delete');
Route::get('categoryIndex', 'CategoryController@index');
Route::get('category/{id}', 'CategoryController@get');

Route::post('addSoftware', 'SoftwareController@store');
Route::post('updateSoftware/{id}', 'SoftwareController@update');
Route::post('deleteSoftware/{id}', 'SoftwareController@delete');
Route::get('softwareIndex', 'SoftwareController@index');
Route::get('software/{id}', 'SoftwareController@get');

Route::post('signUp', 'UserController@signUp');
Route::post('signIn', 'UserController@signIn');

Route::any('{path?}', 'MainController@index')->where("path", ".+");
