<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Profile;
use Session;
use Auth;

class ProfileController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
    }

    /**
     * Create a new profile instance
     * 
     * @param Request $request
     * @return Reponse
     * 
     *
	*/
    public function store(Request $request)
    {
		Log::info('Validating profile registration info!');
		$this->validate($request, [
            'name' => 'required|min:3|unique:profile',
            'password' => 'required|min:3|',
            'description' => 'required|min:3'
        ]);
        
        Log::info('Creating new profile!');
        $profile = new Profile;
        $profile->name = $request->name;
        $profile->password = $request->password;
        $profile->description = $request->description;
        $profile->save();
        
        return $profile;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		//$profile = Auth::guard('profile')->user(); // Get Authenticated profile
		$profile = \App\Profile::where('id', $id)->first();
		Log::info('Validating profile update info!');
        $validatedData = $this->validate($request, [
            //'name' => 'required|min:3|unique:profile,name',
            'name' => 'required|min:3|unique:profile,id,'.$id,
            'password' => 'required|min:3',
            'description' => 'required|min:3',
        ]);
        
		Log::info('Updating profile!');
		Log::info('Original profile name: '. $profile->name);
		Log::info('New profile name: '. $request->name);
        $profile->name = $request->name;
        $profile->password = $request->password;
        $profile->description = $request->description;
        $profile->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
