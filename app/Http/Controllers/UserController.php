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

	public function postSignin(Request $request) {	
		
		// Validate input of form
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|min:3'
        ]);

		// Extract data from form
		$name = $request->input('name');
		$password = $request->input('password');
		
		// Store data in global variable
		$user = \App\User::where('name', $name)->first();
		
		// Incorrect password
		if($password != $user->profile->password){
			Log::info('my special error');
			return back();
		}
		
		// Login to user's account
		if(!is_null($user)) {
			Log::info('I logged in!');
			return redirect()->route('user.getUserView', ['user' => $user]);
		}
		// Admin Login
		else {
			return redirect('/');
		}
    }
    
	public function getUserView(\App\User $user) {
		Log::info('I went back to the main page!');
		$communities = \App\Community::where('managed_by', $user->name)->get();
		return view('user.user', ['user' => $user, 'communities' => $communities]);
	}

}
