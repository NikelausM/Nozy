<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Auth;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Auth\LoginController As BaseLoginController;
use Illuminate\Support\Facades\Auth;

use App\User;

class UserLoginController extends BaseLoginController
{
	protected $redirectTo = '/'; // Get user
	
	public function __construct() {
		Log::info('userLoginController Constructor middleware being called!');
		$this->middleware('guest:profile')->except(['login','logout']);
	}
	
	public function login(Request $request) {	
		Log::info('Getting credentials!');
		// Get credentials
		$credentials = $request->only('name', 'password');
		
		Log::info('Trying to authenticate!');
		//Log::info('Trying to authenticate: '.$credentials->$name.' '.$credentials->$password);
		//if (Auth::guard('profile')->attempt(['name' => $credentials->$name, 'password' => $credentials->password])) {
		if (Auth::guard('profile')->attempt($credentials)) {
			Log::info('Authentication passed!');
			// Authentication passed
			return redirect('user/');
        } else {
			Log::info('Authentication failed!');
            Session::flash ('message', 'Invalid Credentials , Please try again.');
            return redirect('/');
        }
	}
    
    // Overwrite username() method because we want username column as primary key
    // rather than default email id
    public function username() {
		return 'username';
	}
	
	// Overwrite guard() method, which should return account guard
	protected function guard() {
		return Auth::guard('profile');
	}
	
	// Logout user
	public function logout(Request $request) {
		Log::info('Trying to logout!');
		$this->guard('profile')->logout();
		$request->session()->invalidate();
		//$request->session()->flush();
		//return $this->loggedOut($request) ?: redirect('/');
		//return redirect('/');
		return redirect('/');
		
		//Session::flush();
		//Auth::guard('profile')::logout();
		//return redirect()->route('/');
	}
}
