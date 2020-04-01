<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
* Provides data fields and methods to manipulate a PHP data-type representing the index page a PHP application.
* @author Nozy team
*
*/
class IndexController extends Controller
{
	/**
	* Show the application dashboard.
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function getIndex()
	{
		return view('index');
	}

}
