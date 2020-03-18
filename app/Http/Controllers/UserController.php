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
		//$this->middleware('auth:profile')->except(['register']);
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

    // Get user of current authenticated profile
    public function index() {
		Log::info('Trying to UserController.index!');
		//if (Auth::guard('profile')->check()) {
			Log::info('Trying to get user!');
			$profile = Auth::guard('profile')->user(); // Get Authenticated profile
			$user = \App\User::where('profile_id', $profile->id)->first();
			return redirect()->route('user.show', $user);
		//}
	}

    // Store a new user
    public function store(Request $request) {

		# Call parent store function (basically a model constructor)
		Log::info('Calling Profile::store()!');
		$profile = parent::store($request);

		# Validate form
		Log::info('Validating user registration info!');
		$this->validate($request, [
			'email' => 'email|required',
			'password' => 'required|min:3',
			'age' => 'required',
		]);

		# Create new user
		Log::info('Creating new user!');
        $user = new User;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->profile_id = $profile->id;
        $user->save();

        Log::info('Created user, trying to login!');

        $credentials = array('name' => $request->name, 'password' => $request->password);

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

		// Get view of user
		public function show($id) {

			// Retrieve user
			$user = \App\User::where('id', $id)->first();

			Log::info('Trying to getUserView!');
			Log::info('I went back to the user page!');
			return view('user.user', ['user' => $user, 'profile' => $user->profile]);
		}

		// edit

    // Update user info
    public function update(Request $request, $id) {

		// Retrieve user
		$user = \App\User::where('id', $id)->first();

		# Call parent update function (basically a model updater)
		Log::info('Calling Profile::update()!');
		parent::update($request, $user->profile->id);

		# Validate user update
		Log::info('Validating user update info!');
		$validatedData = $this->validate($request, [
            'email' => 'required',
            'age' => 'required',
        ]);

        // Update other attributes
        $user->email = $request->email;
        $user->age = $request->age;
        $user->save();


		return redirect()->route('user.show', ['user' => $user]);
	}


}
