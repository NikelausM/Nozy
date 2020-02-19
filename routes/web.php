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

Route::post('user/signup', ['uses' => 'UserController@postSignup', 'as' => 'user.signup']);

Route::post('user/signin', ['uses' => 'UserController@postSignin', 'as' => 'user.signin']);

Route::get('user/{name}', ['uses' => 'UserController@getUserView', 'as' => 'user.getUserView']);
