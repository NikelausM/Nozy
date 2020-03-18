<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Auth;

class CommunityController extends ProfileController
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		# Call parent store function (basically a model constructor)
		Log::info('Calling Profile::store()!');
		$profile = parent::store($request);

		# Create new user
		Log::info('Creating new community!');
        $community = new Community;
        $community->profile_id = $profile->id;
        $community->save();

        Log::info('Created community, trying to login!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		Log::info('I tried to show the community!');

    // Get Authenticated profile
    $profile = Auth::guard('profile')->user();
    $user = \App\User::where('profile_id', $profile->id)->first();

		// Retrieve community
    Log::info('community:'.$id);
		$community = \App\Community::where('id', $id)->first();
		return redirect()->route('community.showUserCommunity', ['user' => $user, 'community' => $community]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserCommunity(\App\User $user, \App\Community $community)
    {
    Log::info('I tried to show the user community!');

    // Retrieve community
    return view('community.community', ['community' => $community]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		// Retrieve community
		$community = \App\Community::where('id', $id)->first();

		# Call parent update function (basically a model updater)
		Log::info('Calling Profile::update()!');
		parent::update($request, $community->profile->id);
		return redirect()->back();
    }
/*
	public function updateUserCommunity(Request $request, \App\User $user, \App\Community $community) {
		CommunityController::update($request, $community->id);
		return redirect()->back();
	}
*/
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
