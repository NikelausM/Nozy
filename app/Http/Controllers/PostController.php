<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Post;
use App\LikeDislike;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
* Provides data fields and methods to manipulate a PHP data-type representing a Post in a PHP application.
* @author Nozy team
*
*/
class PostController extends Controller
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
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    Log::info('I tried to store the post!');

    // Get Authenticated profile
    $profile = Auth::guard('profile')->user();

    # Create new user
    Log::info('Creating new post!');
    $post = Post::create(array(
      'subject' => $request->subject,
      'body' => $request->body,
      'posted_on_profile_id' => $request->post_profile_id,
      'posted_by_profile_id' => $profile->id,
    ));

    $notificationController = new NotificationController();
    $notificationController->storePost($post);

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
    Log::info('I tried to show the post!');

    // Retrieve post
    $post = \App\Post::where('id', $id)->first();
    $post_profile = $post->posted_on_profile;

    // Check if profile corresponds to User or Community
    $user_posted_on = \App\User::where('profile_id',$post_profile->id)->first();
    if(!is_null($user_posted_on)) {

      return redirect()->route('post.showUserPost',['user' => $user_posted_on, 'post' => $post]);
    }
    else {
      $community_posted_on = \App\Community::where('profile_id',$post_profile->id)->first();
      return redirect()->route('post.showCommunityPost',['community' => $community_posted_on, 'post' => $post]);
    }

  }

  /**
  * Display the specified user post resource.
  *
  * @param  \App\User $user
  * @param \App\Post $post
  * @return \Illuminate\Http\Response
  */
  public function showUserPost(\App\User $user, \App\Post $post)
  {
    $comments = PostController::showComments($post);

    return view('post.post', ['post' => $post, 'comments' => $comments]);
  }

  /**
  * Display the specified community post resource.
  *
  * @param  \App\Community $community
  * @param \App\Post $post
  * @return \Illuminate\Http\Response
  */
  public function showCommunityPost(\App\Community $community, \App\Post $post)
  {
    $comments = PostController::showComments($post);

    return view('post.post', ['post' => $post, 'comments' => $comments]);
  }

  /**
  * Display the specified post's comments
  *
  * @param  \App\Post $post_profile
  * @return \Illuminate\Http\Response
  */
  public function showComments(\App\Post $post) {
    try {
      $client = new \GuzzleHttp\Client(['base_uri' => 'http://ec2-3-101-22-8.us-west-1.compute.amazonaws.com/']);
      $api_response = $client->request('GET','/api/comments/postId/'.$post->id);
      $comments = collect(json_decode($api_response->getBody())); // get comments
    }
    catch (\GuzzleHttp\Exception\RequestException $e) {
      $comments = collect(json_decode(json_encode(array(array("message" => "no comments available at the moment.\r\nplease try again later...",
      "status" => "error"), 404))));
      Session::flash("show_comments_error", $comments[0]->message);
    }
    if (array_key_exists("message", $comments[0]) && !array_key_exists("body", $comments[0])) {
      Session::flash("no_comments_message", $comments[0]->message);
    }
    Session::put('unique_id', 0); // reset unique id
    return $comments;
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
    $post = \App\Post::where('id', $id)->first();
    $post->subject = $request->subject;
    $post->body = $request->body;
    $post->save();

    return redirect()->back();
  }

  /**
  * Like the specified post resource.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function like(Request $request, $id) {

    // Get Authenticated profile
    $profile = Auth::guard('profile')->user();

    // Retrieve post
    $post = \App\Post::where('id', $id)->first();

    // Retrieve likes and dislikes that current logged in profile made for post
    $like = \App\LikeDislike::where([['type','like'],['post_id',$post->id],['profile_id',$profile->id]])->first();
    $dislike = \App\LikeDislike::where([['type','dislike'],['post_id',$post->id],['profile_id',$profile->id]])->first();

    // Check if profile hasn't already liked post
    $notificationController = new NotificationController();
    if (is_null($like)) {
      // If they disliked it before then increase rating and delete dislike
      if (!is_null($dislike)) {
        $post->rating++;
        $dislike->delete();
      }
      // Increase rating and create like
      $post->rating++;
      $post->save();
      $like = new LikeDislike;
      $like->type = 'like';
      $like->post_id = $post->id;
      $like->profile_id = $profile->id;
      $like->save();
      $notificationController->storeRating($like);
    }
    else {
      // If they already liked the post then just delete their like
      $post->rating--;
      $post->save();
      $notificationController->storeRating($like);
      $like->delete();
    }

    return redirect()->back();
  }

  /**
  * Dislike the specified post resource.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function dislike(Request $request, $id) {

    // Get Authenticated profile
    $profile = Auth::guard('profile')->user();

    // Retrieve post
    $post = \App\Post::where('id', $id)->first();

    // Retrieve dislikes that current logged in profile made for post
    $like = \App\LikeDislike::where([['type','like'],['post_id',$post->id],['profile_id',$profile->id]])->first();
    $dislike = \App\LikeDislike::where([['type','dislike'],['post_id',$post->id],['profile_id',$profile->id]])->first();

    // Check if profile hasn't already disliked post
    $notificationController = new NotificationController();
    if (is_null($dislike)) {
      // If they liked it before then decrease rating and delete like
      if (!is_null($like)) {
        $post->rating--;
        $like->delete();
      }
      // Decrease rating and create dislike
      $post->rating--;
      $post->save();
      $dislike = new LikeDislike;
      $dislike->type = 'dislike';
      $dislike->post_id = $post->id;
      $dislike->profile_id = $profile->id;
      $dislike->save();
      $notificationController->storeRating($dislike);
    }
    else {
      // If they already disliked the post then just delete their dislike
      $post->rating++;
      $post->save();
      $notificationController->storeRating($dislike);
      $dislike->delete();
    }

    return redirect()->back();
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    Log::info("Trying to delete post");
    // Retrieve post and its profile
    $post = \App\Post::where('id', $id)->first();
    $post_profile = $post->posted_on_profile;

    // Delete associated $comments
    $this->destroyPostComments($post);

    // Delete post
    $post->delete();

    // Check if profile corresponds to User or Community
    $user_posted_on = \App\User::where('profile_id',$post_profile->id)->first();
    if(!is_null($user_posted_on)) {
      return redirect()->route('user.show',$user_posted_on);
    }
    else {
      $community_posted_on = \App\Community::where('profile_id',$post_profile->id)->first();
      return redirect()->route('community.show',$community_posted_on);
    }
  }

  /**
  * Remove the comments of the specified post from storage.
  *
  * @param  Post $post
  */
  public function destroyPostComments(Post $post) {
    Log::info("Trying to destroy post comments");
    try {
      $client = new \GuzzleHttp\Client(['base_uri' => 'http://ec2-3-101-22-8.us-west-1.compute.amazonaws.com/']);
      $api_response = $client->request('GET','/api/comments/postId/'.$post->id);
      $comments = collect(json_decode($api_response->getBody())); // get comments
      if (array_key_exists("message", $comments[0]) && !array_key_exists("body", $comments[0])) {
        Session::flash("no_comments_message", $comments[0]->message);
      }
      else {
        $commentController = new CommentController();
        Log::info("Comments received: ".$comments);
        foreach($comments as $comment) {
          Log::info("comment id: ".$comment->id);
          $commentController->destroyWithOnlyId((int) $comment->id);
        }
      }
    }
    catch (\GuzzleHttp\Exception\RequestException $e) {
      Log::info("Unable to destroy post comments");
      $comments = collect(json_decode(json_encode(array(array("message" => "no comments available at the moment.\r\nplease try again later...",
      "status" => "error"), 404))));
      Session::flash("destroy_post_comments_error", $comments[0]->message);
    }
  }
}
