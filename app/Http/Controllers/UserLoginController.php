<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Auth\LoginController As BaseLoginController;
use Illuminate\Support\Facades\Auth;

//use Auth;
use Session;
use App\User;

/**
* Provides data fields and methods to control the user login functionality in a PHP application.
* @author Nozy team
*
*/
class UserLoginController extends BaseLoginController
{
	/**
	* The url that a user is automatically redirected to
	* @var string
	*/
	protected $redirectTo = '/'; // Get user

	/*
	* only authenticated user with profile guard
	* can access this controller.
	*/
	public function __construct() {
		Log::info('userLoginController Constructor middleware being called!');
		//$this->middleware('guest:profile')->except(['login','logout']);
	}

	/**
	* Login the specified user.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function login(Request $request) {
		Log::info('Getting credentials!');
		// Get credentials
		$credentials = $request->only('name', 'password');

		Log::info('Trying to authenticate!');
		Log::info('specifically:'.$request->name.' '.$request->password);

		if (Auth::guard('profile')->attempt($credentials)) {
			Log::info('Authentication passed!');

			return redirect('user/');
		} else {
			Log::info('Authentication failed!');
			Session::flash ('message', 'Invalid Credentials , Please try again.');
			return redirect('/');
		}
	}

	/**
	* Overwrite username() method because we want to username
	* rather than default email id
	*/
	public function username() {
		return 'username';
	}

	/**
	* Overwrite guard() method, which should return account guard
	*/
	protected function guard() {
		return Auth::guard('profile');
	}

	/**
	* Logout the specified user.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function logout(Request $request) {
		Log::info('Trying to logout!');
		$this->guard('profile')->logout();
		$request->session()->invalidate();
		return redirect('/');
	}
}
