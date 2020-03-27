<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Post;
use App\LikeDislike;
use App\Notification;

/*
Notifications possible are:
  - Posting on a user profile (user gets notified)
  - Posting on a community profile (community owner (a user) gets notified)
  - Profile is posted on (all followers of profile are notified)
  - Post is rated (post owner gets notified)
  - Commenting on a post (post owner gets notified)
*/

class NotificationController extends Controller
{
  /**
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $notifications = \App\Notification::where('notifee_id', Auth::guard('profile')->user()->id)->get();
    return view('notifications.notifications', ['notifications' => $notifications]);
  }

  public function createPostNotification(\App\Profile $poster_profile, $owner_profile_ID, $post_ID)
  {
    Log::info('I am trying to create a post notification');

    // Check if profile corresponds to User or Community
    $user_posted_on = \App\User::where('profile_id',$post_profile->id)->first();

    if(!is_null($user_posted_on)) {
    \App\Notification::create(array(
      'notifee_id' => $owner_profile_ID,
			'post_id' => $post_ID,
      'notification_type' => $poster_profile->name . " has posted on your wall",
      'profile_id' => $poster_profile->id,
    ));
    } else {
      $community_posted_on = \App\Community::where('profile_id',$post_profile->id)->first();
      \App\Notification::create(array(
        'notifee_id' => $community_posted_on->user()->id,
  			'post_id' => $post_ID,
        'notification_type' => $poster_profile->name . " has posted on your community: " . $community_posted_on->profile()->name,
        'profile_id' => $poster_profile->id,
      ));
    }

    return redirect()->route('user.show', \App\user::where('id', $profile_profile->user()->id));
  }

  // message will be like the page 'pagename' has a new post
  // createPostNotification would have to call this function
  // should make post_id nullable, in which case post_id here would be null
  public function notifyAllFollowers($followee_ID, $post_ID, $message)
  {
    Log::info('I am trying to create a post notification for every follower');
    $followingUsers_ids = App\Following::where('follower_id', $followee_ID)->get()->followee_id;

    foreach($followingUsers_ids as $followerID)
    {
      \App\Notification::create(array(
        'notifee_id' => $followerID
  			'post_id' => 0,
        'notification_type' => $message,
        'profile_id' => $followee_ID,
      ));
    }
  }

  // assuming you only can like or dislike posts (and not comments)
  public function createRatingNotification($poster_ID, $owner_ID, $post_ID, $isLike)
  {
    Log::info('I am trying to create a like notification');
  }

  // post ID here should also be NULL
  public function createFollowNotification($follower_profile, $profileBeingFollowed_ID)
  {
    Log::info('I am trying to create a follow notification, and add the follower');

    // Check if profile corresponds to User or Community
    $user_posted_on = \App\User::where('profile_id',$profileBeingFollowed_ID)->first();

    if(!is_null($user_posted_on)) {
    \App\Notification::create(array(
      'notifee_id' => $profileBeingFollowed_ID,
			'post_id' => 0,
      'notification_type' => $follower_profile->name . " has followed your user page",
      'profile_id' => $follower_profile->id,
    ));
    } else {
      $community_posted_on = \App\Community::where('profile_id',$post_profile->id)->first();
      \App\Notification::create(array(
        'notifee_id' => $community_posted_on->user()->id,
  			'post_id' => 0,
        'notification_type' => $follower_profile->name . " has followed your community: " . $community_posted_on->profile()->name,
        'profile_id' => $follower_profile->id,
      ));
    }
  }

  public function createCommentNotification($poster_ID, $postOwner_ID, $post_ID, $commentOwner_ID)
  {
    Log::info('I am trying to create a comment notification');
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
