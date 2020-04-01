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

/**
* Provides data fields and methods to manipulate a PHP data-type representing a Notification in a PHP application.
* @author Nozy team
*
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

  /**
  * Store a newly created notification resource in storage.
  *
  * @param \App\Post $post
  * @return \Illuminate\Http\Response
  */
  public function storePost(Post $post) {
    $this->storePostedOnProfile($post);
    $this->storePostedByProfile($post);
  }

  /**
  * Store a newly created notification resource for posts on followed profiles in storage.
  *
  * @param \App\Post $post
  * @return \Illuminate\Http\Response
  */
  public function storePostedOnProfile(Post $post)
  {
    Log::info('posted on: '.$post->posted_on_profile);
    // Create notifications for each follower
    foreach($post->posted_on_profile->followings as $following)
    {
      // Create notification
      $notification = new Notification();
      $notification->following_id = $following->id;
      $notification->follower_id = $following->follower_id;
      $notification->message = $post->posted_on_profile->name." has a new post on their profile!";
      $notification->save();
    }
  }

  /**
  * Store a newly created notification resource for posts of followed profiles in storage.
  *
  * @param \App\Post $post
  * @return \Illuminate\Http\Response
  */
  public function storePostedByProfile(Post $post)
  {
    // Create notifications for each follower
    foreach($post->posted_by_profile->followings as $following)
    {
      // Create notification
      $notification = new Notification();
      $notification->following_id = $following->id;
      $notification->follower_id = $following->follower_id;
      $notification->message = $post->posted_by_profile->name." made a new post on the profile of ".$post->posted_on_profile->name."!";
      $notification->save();
    }
  }

  /**
  * Store a newly created notification resource for likes in storage.
  *
  * @param \App\Likedislike likedislike
  * @return \Illuminate\Http\Response
  */
  public function storeRating(LikeDislike $likedislike)
  {
    Log::info('Trying to create notification for post like or dislike');

    // Create notifications for each follower
    foreach($likedislike->post->followings as $following)
    {
      // Create notification
      $notification = new Notification();
      $notification->following_id = $following->id;
      $notification->follower_id = $following->follower_id;
      $notification->message = "The post '".$likedislike->post->subject."' was rated by ".$likedislike->profile->name."!";
      $notification->save();
    }
  }

  /**
  * Store a newly created notification resource for comments in storage.
  *
  * @param \App\Post $post
  * @return \Illuminate\Http\Response
  */
  public function storeComment(Post $post)
  {
    Log::info('Trying to create notification for comment on post page');

    // Retrieve commenter profiles
    $profile = Auth::guard('profile')->user();

    // Create notifications for each follower
    foreach($post->followings as $following)
    {
      Log::info('following: '.$following);
      // Create notification
      $notification = new Notification();
      $notification->following_id = $following->id;
      $notification->follower_id = $following->follower_id;
      $notification->message = $profile->name." commented on the post '".$post->subject."'!";
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
    Notification::find($id)->first()->delete();
  }
}
