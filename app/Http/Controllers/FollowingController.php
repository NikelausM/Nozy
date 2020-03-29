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

class FollowingController extends Controller
{
  /**
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

  }

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
  public function deleteNotification($id)
  {
    Log::info('I am trying to delete a notification');
  }
}
