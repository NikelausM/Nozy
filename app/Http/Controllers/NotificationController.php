<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Profile;
use App\User;
use App\Community;
use App\Post;
use App\LikeDislike;
use App\Following;
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

  // message will be like the page 'pagename' has a new post
  // createPostNotification would have to call this function
  // should make post_id nullable, in which case post_id here would be null
  public function storePost(Post $post)
  {
    Log::info('I am trying to create post notification for every follower');

    // Create notifications for each follower
    foreach($post->posted_on_profile->followings as $following);
    {
      Log::info('following: '.$following);
      // Create notification
      $notification = new Notification();
      $notification->following_id = $following->id;
      $notification->follower_id = $following->follower_id;
      $notification->save();
    }
  }

  // assuming you only can like or dislike posts (and not comments)
  public function createRatingNotification(LikeDislike $likedislike)
  {
    Log::info('I am trying to create a like notification for every ');
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
