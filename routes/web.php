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

// Search routes accessible to logged-in users
Route::prefix('search/')->middleware('auth:profile')->group(function () {

	Route::get('/', ['uses' => 'SearchController@index', 'as' => 'search.index']);
});

// Post routes accessible to logged-in users
Route::prefix('post/')->middleware('auth:profile')->group(function () {

	Route::post('/', ['uses' => 'PostController@store', 'as' => 'post.store']);
	Route::get('{post}', ['uses' => 'PostController@show', 'as' => 'post.show']); // Determine if post belongs to user or community
});

// User routes accessible to anyone
Route::get('user/', ['uses' => 'UserController@index', 'as' => 'user.index']);
Route::post('user/register', ['uses' => 'UserController@store', 'as' => 'user.store']);
Route::post('user/login', ['uses' => 'UserLoginController@login', 'as' => 'user.postLogin']);

// User routes accessible to logged-in users
Route::prefix('user/')->middleware('auth:profile')->group(function () {

	Route::get('logout', ['uses' => 'UserLoginController@logout', 'as' => 'user.logout']);

	Route::prefix('{user}')->middleware('auth:profile')->group(function () {

		Route::get('/', ['uses' => 'UserController@show', 'as' => 'user.show']);

		Route::post('/', ['uses' => 'UserController@update', 'as' => 'user.update']);

		// Routes for specific post of community
		Route::prefix('post/{post}')->group(function () {
			Route::get('/', ['uses' => 'PostController@showUserPost', 'as' => 'post.showUserPost']);
		});
	});
});

// Community routes accessible to logged-in users
Route::prefix('community/')->middleware('auth:profile')->group(function () {

	Route::post('/', ['uses' => 'CommunityController@store', 'as' => 'community.store']);

	Route::prefix('community/{community}')->middleware('auth:profile')->group(function () {

		Route::get('/', ['uses' => 'CommunityController@show', 'as' => 'community.show']);

		Route::post('/', ['uses' => 'CommunityController@update', 'as' => 'community.update']);

		Route::prefix('post/{post}')->group(function () {
			Route::get('/', ['uses' => 'PostController@showCommunityPost', 'as' => 'post.showCommunityPost']);
		});
	});
});
