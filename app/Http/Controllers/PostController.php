<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;


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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
