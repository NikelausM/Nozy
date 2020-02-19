<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getIndex()
    {
		return view('index');
	}

	public function getAddToCart(Request $request, $id) {
		$item = Item::find($id);
	}
}
