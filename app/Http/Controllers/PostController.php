<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Post;
use App\LikeDislike;

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
      \App\Post::create(array(
          'subject' => $request->subject,
          'body' => $request->body,
          'posted_on_profile_id' => $request->post_profile_id,
          'posted_by_profile_id' => $profile->id,
      ));

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserPost(\App\User $user, \App\Post $post)
    {
      return view('post.post', ['post' => $post]);
    }

    /**
     * Display the specified community post resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showCommunityPost(\App\Community $community, \App\Post $post)
     {
      return view('post.post', ['post' => $post]);
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

  		# Call parent update function (basically a model updater)
  		return redirect()->back();
    }

    // Like the post
    public function like(Request $request, $id) {

      // Get Authenticated profile
      $profile = Auth::guard('profile')->user();

      // Retrieve post
      $post = \App\Post::where('id', $id)->first();

      // Retrieve likes and dislikes that current logged in profile made for post
      $like = \App\LikeDislike::where([['type','like'],['post_id',$post->id],['profile_id',$profile->id]])->first();
      $dislike = \App\LikeDislike::where([['type','dislike'],['post_id',$post->id],['profile_id',$profile->id]])->first();

      // Check if profile hasn't already liked post
      if (is_null($like)) {
        // If they disliked it before then increase rating and delete dislike
        if (!is_null($dislike)) {
          $post->rating++;
          $dislike->delete();
        }
        // Increase rating and create like
        $post->rating++;
        $post->save();
        $new_like = new LikeDislike;
        $new_like->type = 'like';
        $new_like->post_id = $post->id;
        $new_like->profile_id = $profile->id;
        $new_like->save();
      }
      else {
        // If they already liked the post then just delete their like
        $post->rating--;
        $post->save();
        $like->delete();
      }

  		return redirect()->back();
    }

    // Dislike the post
    public function dislike(Request $request, $id) {

      // Get Authenticated profile
      $profile = Auth::guard('profile')->user();

      // Retrieve post
      $post = \App\Post::where('id', $id)->first();

      // Retrieve dislikes that current logged in profile made for post
      $like = \App\LikeDislike::where([['type','like'],['post_id',$post->id],['profile_id',$profile->id]])->first();
      $dislike = \App\LikeDislike::where([['type','dislike'],['post_id',$post->id],['profile_id',$profile->id]])->first();

      // Check if profile hasn't already disliked post
      if (is_null($dislike)) {
        // If they liked it before then decrease rating and delete like
        if (!is_null($like)) {
          $post->rating--;
          $like->delete();
        }
        // Decrease rating and create dislike
        $post->rating--;
        $post->save();
        $new_dislike = new LikeDislike;
        $new_dislike->type = 'dislike';
        $new_dislike->post_id = $post->id;
        $new_dislike->profile_id = $profile->id;
        $new_dislike->save();
      }
      else {
        // If they already disliked the post then just delete their dislike
        $post->rating++;
        $post->save();
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

      // Retrieve post and its profile
      $post = \App\Post::where('id', $id)->first();
      $post_profile = $post->posted_on_profile;

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
}
