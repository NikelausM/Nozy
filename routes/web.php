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
	Route::get('/search', ['uses' => 'SearchController@search', 'as' => 'search.search']);
});

// Following routes accessible to logged-in users (added by nicolas)
Route::prefix('following/')->middleware('auth:profile')->group(function(){
	Route::get('/', ['uses' => 'NotificationController@index', 'as' => 'following.index']);
	Route::post('/', ['uses' => 'FollowingController@store', 'as' => 'following.store']);
	Route::delete('/delete', ['uses' => 'FollowingController@destroy', 'as' => 'following.destroy']);
});

// Notification routes accessible to logged-in users (added by naweed)
Route::prefix('notifications/')->middleware('auth:profile')->group(function(){
	Route::get('/', ['uses' => 'NotificationController@index', 'as' => 'notifications.index']);
	Route::post('/post', ['uses' => 'NotificationController@storePost', 'as' => 'notifications.storePost']);
	Route::post('/comment', ['uses' => 'NotificationController@storeComment', 'as' => 'notifications.storeComment']);
	Route::post('/rate', ['uses' => 'NotificationController@storeRate', 'as' => 'notifications.storeRate']);
	Route::post('/following', ['uses' => 'NotificationController@storeFollowing', 'as' => 'notifications.storeFollowing']);
	Route::delete('/delete', ['uses' => 'NotificationController@deleteNotification', 'as' => 'notifications.destroy']);
});


// Comment routes accessible to logged in users
Route::prefix('comment/')->middleware('auth:profile')->group(function () {
	Route::post('/', ['uses' => 'CommentController@store', 'as' => 'comment.store']);
	Route::prefix('{comment}')->group(function () {
		Route::post('/', ['uses' => 'CommentController@update', 'as' => 'comment.update']);
		Route::delete('/', ['uses' => 'CommentController@destroy', 'as' => 'comment.destroy']);
	});
});

// Post routes accessible to logged-in users
Route::prefix('post/')->middleware('auth:profile')->group(function () {

	Route::post('/', ['uses' => 'PostController@store', 'as' => 'post.store']);

	Route::prefix('/{post}')->group(function () {
		Route::get('/', ['uses' => 'PostController@show', 'as' => 'post.show']); // Determine if post belongs to user or community
		Route::post('/', ['uses' => 'PostController@update', 'as' => 'post.update']);
		Route::delete('/', ['uses' => 'PostController@destroy', 'as' => 'post.destroy']);

		Route::post('/like', ['uses' => 'PostController@like', 'as' => 'post.like']);
		Route::post('/dislike', ['uses' => 'PostController@dislike', 'as' => 'post.dislike']);
	});
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

	Route::prefix('{community}')->middleware('auth:profile')->group(function () {

		Route::get('/', ['uses' => 'CommunityController@show', 'as' => 'community.show']);

		Route::post('/', ['uses' => 'CommunityController@update', 'as' => 'community.update']);

		Route::delete('/', ['uses' => 'CommunityController@destroy', 'as' => 'community.destroy']);

		Route::prefix('post/{post}')->group(function () {
			Route::get('/', ['uses' => 'PostController@showCommunityPost', 'as' => 'post.showCommunityPost']);
		});
	});
});
