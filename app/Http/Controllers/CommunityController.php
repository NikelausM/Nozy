<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Auth;
use App\Profile;
use App\Community;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

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

    private function storeSuper(Request $request) {
      Log::info('Calling Profile::store()!');
      $profile = new ProfileController();
      $request->unique_id--;
  		$profile = $profile->store($request);
      $request->unique_id++;
      return $profile;
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
    $profile = $this->storeSuper($request);
    if ($profile instanceOf ProfileController) {
      Log::info("storeValidator: ".$profile->storeErrors);
      return redirect()->back()->withErrors($profile->storeValidator, $profile->storeErrors);
    }

    Log::info('Trying to store community');
    // Check that all required fields are filled
    $validator = Validator::make($request->all(), [
            'manager_user_id' => 'required',
    ]);

    // If required fields aren't flled
    if ($validator->fails()) {
      Log::info('Failed to create profile');
      Session::flash("store_community_error_".$request->unique_id, "unable to create community at the moment\r\nplease try again...");
      return redirect()->back()->withErrors($validator,'storeCommunityErrors');
    }

		# Create new community
		Log::info('Creating new community!');
    $community = new Community;
    $community->profile_id = $profile->id;
    $community->manager_user_id = $request->manager_user_id;
    $community->save();

    Log::info('Created community, trying to login!');

    return redirect()->back();
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

		// Retrieve community
    Log::info('community:'.$id);
		$community = \App\Community::where('id', $id)->first();
		 return view('community.community', ['community' => $community, 'profile' => $community->profile]);
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

    private function storeUpdate(Request $request, $id) {
      Log::info('Calling Profile::update()!');
      $profile = new ProfileController();
      $request->unique_id--;
  		$profile = $profile->update($request, $id);
      $request->unique_id++;
      return $profile;
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
  		//Log::info('Calling Profile::update()!');
  		//parent::update($request, $community->profile->id);

      # Call parent store function (basically a model constructor)
      $profile = $this->storeUpdate($request, $community->profile->id);
      if ($profile instanceOf ProfileController) {
        Log::info("updateValidator: ".$profile->updateErrors);
        return redirect()->back()->withErrors($profile->updateValidator, $profile->updateErrors);
      }

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
        $community = \App\Community::find($id);
        $community->profile->delete();
        $user = \App\User::where('profile_id', Auth::guard('profile')->user()->id)->first();
        return redirect()->route('user.show', $user);
    }
}
