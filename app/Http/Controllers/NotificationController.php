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
  public function storePost(Post $post) {
    $this->storePostedOnProfile($post);
    $this->storePostedByProfile($post);
  }

  // Create notification for each class following post made on profile
  public function storePostedOnProfile(Post $post)
  {
    Log::info('posted on: '.$post->posted_on_profile);
    // Create notifications for each follower
    foreach($post->posted_on_profile->followings as $following)
    {
      Log::info('following: '.$following);
      // Create notification
      $notification = new Notification();
      $notification->following_id = $following->followingable_id;
      $notification->follower_id = $following->follower_id;
      $notification->message = $post->posted_on_profile->name." has a new post on their profile!";
      $notification->save();
    }
  }

  // Create notification for each class following post made by profile
  public function storePostedByProfile(Post $post)
  {
    Log::info('posted by: '.$post->posted_by_profile);
    // Create notifications for each follower
    foreach($post->posted_by_profile->followings as $following)
    {
      Log::info('following: '.$following);
      // Create notification
      $notification = new Notification();
      $notification->following_id = $following->followingable_id;
      $notification->follower_id = $following->follower_id;
      $notification->message = $post->posted_by_profile->name." made a new post on the profile of ".$post->posted_on_profile->name."!";
      $notification->save();
    }
  }

  // assuming you only can like or dislike posts (and not comments)
  public function storeRating(LikeDislike $likedislike)
  {
    Log::info('Trying to create notification for post like or dislike');

    // Create notifications for each follower
    foreach($likedislike->post->followings as $following)
    {
      Log::info('following: '.$following);
      // Create notification
      $notification = new Notification();
      $notification->following_id = $following->followingable_id;
      $notification->follower_id = $following->follower_id;
      $notification->message = "The post '".$likedislike->post->subject."' was rated by ".$likedislike->profile->name."!";
      $notification->save();
    }
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
