<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Profile;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;

/**
* Provides data fields and methods to manipulate a PHP data-type representing a Profile in a PHP application.
* @author Nozy team
*
*/
class ProfileController extends Controller
{
/**
 * The validator for storing a Profile
 * @var \Illuminate\Support\Facades\Validator
 */
  protected $storeValidator;

  /**
   * The error message variable name for storing a Profile
   * @var string
   */
  protected $storeErrors = "storeProfileErrors";

  /**
   * The validator for updating a profile
   * @var \Illuminate\Support\Facades\Validator
   */
  protected $updateValidator;

  /**
   * The error message variable name for updating a Profile
   * @var string
   */
  protected $updateErrors = "updateProfileErrors";

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
    Log::info('Request all: '.json_encode($request->all()));
    Log::info('Trying to store profile');
    $validator = Validator::make($request->all(), [
      'name' => 'required|min:3|unique:profile',
      'password' => 'required|min:3|',
      'description' => 'required|min:3'
    ]);

    // If required filed aren'tflled
    Log::info("Checking if profile store failed");
    if ($validator->fails()) {
      Log::info("Failed to store profile");
      Session::flash("store_profile_error_".$request->unique_id, "unable to create profile at the moment\r\nplease try again...");
      Log::info("store_profile_error_id: ".$request->unique_id);
      $this->storeValidator = $validator;
      return $this;
    }

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
    // Getting current authorized profile
    $profile = \App\Profile::where('id', $id)->first();

    Log::info('Validating profile update info!');
    $validator = Validator::make($request->all(), [
      //'name' => 'required|min:3|unique:profile,name',
      'name' => 'required|min:3|unique:profile,id,'.$id,
      'password' => 'required|min:3',
      'description' => 'required|min:3',
    ]);

    // If required filed aren'tflled
    Log::info("Checking if profile update failed");
    if ($validator->fails()) {
      Log::info("Failed to update profile");
      Session::flash("update_profile_error_".$request->unique_id, "unable to update profile at the moment\r\nplease try again...");
      Log::info("update_profile_error_: ".$request->unique_id);
      $this->updateValidator = $validator;
      return $this;
    }

    // Updating profile
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
    $profile = Profile::find($id);
    $profileController = new PostController();
    foreach($profile->posts as $post) {
      $profileController->destroyPostComments($post);
    }
    $profile->delete();
  }
}
