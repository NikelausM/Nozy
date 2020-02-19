<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
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

	
	public function postSignup(Request $request) {
		$this->validate($request, [
			'email' => 'email|required|unique:user',
			'password' => 'required|min:5',
			'age' => 'required',
		]);
		
		$email = $request->input('email');
		$password = $request->input('password');
		$age = $request->input('age');

		\App\User::create([
           'email' -> $email,
           'password' -> $password,
           'age' -> $age,
        ]);

		return redirect()->back();
	}

	public function postSignin(Request $request) {	
		
		// Validate input of form
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:3'
        ]);

		// Extract data from form
		$email = $request->input('email');
		$password = $request->input('password');
		
		// Store data in global variable
		$user = \App\User::where('email', $email)->first();
		
		// Incorrect password
		if($password != $user->password){
			#return view('/');
			#$out = new Symfony\Component\Console\Output\ConsoleOutput();
			#$out->writeln("<info> my message error</info>");
			Log::info('my special error');
			return back();
		}
		
		// Get profile info
		$profile = \App\Profile::where('email', $email)->first();
		
		// Login to user's account
		if(!is_null($profile)) {
			// put user email into global variable
			$request->session()->put('user', $user);
			return redirect()->route('user.getUserView', ['name' => $profile->name]);
		}
		// Admin Login
		else {
			return redirect('/');
		}
		
    }	
    
    public function getUserView($name) {
		$user = Session::get('user');
		return view('user.user', ['name' => $name, 'user' => $user]);
	}
	

}
