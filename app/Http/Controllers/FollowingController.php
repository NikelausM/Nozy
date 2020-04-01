<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

use Auth;
use App\Profile;
use App\User;
use App\Community;
use App\Post;
use App\LikeDislike;
use App\Following;
use App\Notification;

/**
* Provides data fields and methods to manipulate a PHP data-type representing a Following relattionship between a follower and an entity being followed in a PHP application.
* @author Nozy team
*
*/
class FollowingController extends Controller
{
  /**
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
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
    Log::info('I am trying to create following relationship');

    // Check that all required fields are filled
    $validator = Validator::make($request->all(), [
      'followingable_id' => 'required|numeric',
      'followingable_type' => 'required',
      'follower_id' => 'required|numeric',
    ]);

    // Create following relationship between followingable class and follower class
    try {
      $following = new Following();
      $following->followingable_id = $request->followingable_id;
      $following->followingable_type = $request->followingable_type;
      $following->follower_id = $request->follower_id;
      $following->save();
    }
    catch (QueryException $e) {
      Session::flash("following_error", "Already following this...");
    }
    Session::put('unique_id', 0); // reset unique id
    return redirect()->back();
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroyFollowingProfile(Profile $profile)
  {
    $following = $profile->followings()->where('follower_id', Auth::guard('profile')->user()->id)->first();
    if (is_null($following)) {
      Session::flash("unfollowing_profile_error", "Not following this...");
    }
    else {
      $following->delete();
    }
    return redirect()->back();
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroyFollowingPost(Post $post)
  {
    $following = $post->followings()->where('follower_id', Auth::guard('profile')->user()->id)->first();
    if (is_null($following)) {
      Session::flash("unfollowing_post_error", "Not following this...");
    }
    else {
      $following->delete();
    }
    return redirect()->back();
  }
}
