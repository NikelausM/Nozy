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

Route::get('user/', ['uses' => 'UserController@index', 'as' => 'user.index']);

// Route group
Route::post('user/register', ['uses' => 'UserController@store', 'as' => 'user.store']);
Route::post('user/login', ['uses' => 'UserLoginController@login', 'as' => 'user.postLogin']);

// Routes accessible to logged-in users
Route::prefix('user')->middleware('auth:profile')->group(function () {
	
	Route::get('logout', ['uses' => 'UserLoginController@logout', 'as' => 'user.logout']);
	
	// Routes for specific user
	Route::prefix('{user}')->group(function () {
		
		Route::get('/', ['uses' => 'UserController@show', 'as' => 'user.show']);
		
		Route::post('/', ['uses' => 'UserController@update', 'as' => 'user.update']);
		
		//Route::post('/', ['uses' => 'CommunityController@store', 'as' => 'community.storeUserCommunity');
		
		// Routes for specific community managed by user
		Route::prefix('community/{community}')->group(function () {
			
			Route::get('/', ['uses' => 'CommunityController@showUserCommunity', 'as' => 'community.showUserCommunity']);	
			
			Route::post('/', ['uses' => 'CommunityController@updateUserCommunity', 'as' => 'community.updateUserCommunity']);
			
			// Routes for specific post managed by user
			Route::prefix('post/{post}')->group(function () {
				Route::get('/', ['uses' => 'PostController@showUserCommunityPost', 'as' => 'post.showUserCommunityPost']);	
			
				Route::post('/', ['uses' => 'PostController@updateUserCommunityPost', 'as' => 'post.updateUserCommunityPost']);
			});
		});
		
	});
});
