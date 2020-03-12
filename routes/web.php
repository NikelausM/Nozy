<?php

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

Route::get('/', [ 'uses' => 'IndexController@getIndex', 'as' => 'index']);

Route::post('user/register', ['uses' => 'UserController@store', 'as' => 'user.register']);

Route::post('user/login', ['uses' => 'UserLoginController@login', 'as' => 'user.login']);

Route::get('user/logout', ['uses' => 'UserLoginController@logout', 'as' => 'user.logout']);

Route::get('user/', ['uses' => 'UserController@index', 'as' => 'user.index']);

Route::get('user/{user}', ['uses' => 'UserController@getUserView', 'as' => 'user.getUserView']);
//->middleware('auth:profile');
Route::get('user/{user}/community/{community}/', ['uses' => 'CommunityController@getCommunityView', 'as' => 'community.getCommunityView']);

