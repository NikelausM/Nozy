<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
* Provides data fields and methods to manipulate a PHP data-type representing the home page in a PHP application.
*
*/
class HomeController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Contracts\Support\Renderable
  */
  public function index()
  {
    return view('home');
  }
}
