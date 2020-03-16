<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //
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
      return view('post.post', ['post' => $post]);
      /*
      // Get Authenticated profile
      $profile = Auth::guard('profile')->user();
      $user = \App\User::where('profile_id', $profile->id)->first();

  		Log::info('I tried to show the post!');
  		// Retrieve post
  		$post = \App\Post::where('id', $id)->first();
  		$poster_profile = \App\Profile::where($post->parent_id);
  		// Check if profile corresponds to User or Community
  		$poster_user = \App\User::where('profile_id',$post_creator_profile->id);
  		if(!is_null($poster_user)) {
  			return view('post.post', ['user' => $user, 'poster' => $poster_user, 'post' => $post]);
  		}
  		else {
  			$poster_community = \App\Community::where('profile_id',$profile->id);
  			return view('post.post', ['user' => $user, 'poster' => $poster_community, 'post' => $post]);
  		}
      */
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
