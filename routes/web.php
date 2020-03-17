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
Route::get('post/{post}', ['uses' => 'PostController@show', 'as' => 'post.show']); // Determine if post belongs to user or community

// Routes accessible to logged-in users
Route::prefix('user')->middleware('auth:profile')->group(function () {

	Route::get('logout', ['uses' => 'UserLoginController@logout', 'as' => 'user.logout']);

	// Routes for specific user
	Route::prefix('{user}')->group(function () {

		Route::get('/', ['uses' => 'UserController@show', 'as' => 'user.show']);

		Route::post('/', ['uses' => 'UserController@update', 'as' => 'user.update']);

		Route::get('post', ['uses' => 'PostController@showUserPost', 'as' => 'post.showUserPost']);

		//Route::post('/', ['uses' => 'CommunityController@store', 'as' => 'community.storeUserCommunity');

		// Routes for specific community managed by user
		Route::prefix('community/{community_visited}')->group(function () {

			Route::get('/', ['uses' => 'CommunityController@show', 'as' => 'community.showUserCommunity']);

			Route::post('/', ['uses' => 'CommunityController@update', 'as' => 'community.updateUserCommunity']);

			// Routes for specific post of community
			Route::prefix('post/{post}')->group(function () {
				Route::get('/', ['uses' => 'PostController@showUserCommunityPost', 'as' => 'post.showUserCommunityPost']);

			});
		});

		Route::prefix('user/{user_visited}')->group(function () {
			// Routes for specific post of community
			Route::prefix('post/{post}')->group(function () {
				Route::get('/', ['uses' => 'PostController@showUserUserPost', 'as' => 'post.showUserUserPost']);


			});
		});
	});

});
