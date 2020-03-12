<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Redirect;

use App\User;

class UserController extends ProfileController
{
	/*
	 * only authenticated user with account guard 
	 * can access this controller.
	 */
	public function __construct()
	{
		Log::info('UserController Constructor middleware being called!');
		$this->middleware('auth:profile');
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /*
    public function index()
    {
		$user = \App\User::all();
        return view('viewUsers', ['allUsers' => $user]);
    }
    * */
    public function store(Request $request) {
		
		# Call parent store function (basically a model constructor)
		parent::store($request);
		
		# Validate form
		$this->validate($request, [
			'name' => 'required|min:3|unique:user',
			'email' => 'email|required',
			'password' => 'required|min:3',
			'age' => 'required',
		]);
		
		# Create new user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->save();
        
		return redirect()->route('user.getUserView', ['user' => $user]);
	}
    
    public function index(Request $request) {
		Log::info('Trying to UserController.index!');
		//if (Auth::guard('profile')->check()) {
			Log::info('Trying to get user!');
			$profile = Auth::guard('profile')->user(); // Get Authenticated profile
			$user = \App\User::where('name', $profile->name)->first();
			return redirect()->route('user.getUserView', ['user' => $user]);
		//}
	}
	
	public function getUserView(\App\User $user) {
		Log::info('Trying to getUserView!');
		//if (Auth::guard('profile')->check()) {
			Log::info('I went back to the user page!');
			$communities = \App\Community::where('managed_by', $user->name)->get();
			return view('user.user', ['user' => $user, 'communities' => $communities]);
		//}
	}

}
