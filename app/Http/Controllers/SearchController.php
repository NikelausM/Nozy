<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Profile;
use App\User;
use App\Community;
use App\Post;

/**
* Provides data fields and methods to control the search functionality in a PHP application.
* @author Nozy team
*
*/
class SearchController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view('search.search');
  }

  /**
  * Filter search results.
  *
  * @return \Illuminate\Http\Response
  */
  public function search(Request $request)
  {
    Log::info('Trying to return data!');
    $communities;
    // Live search bar filter
    if ($request->ajax()) {
      $output = "";
      $query = $request->get('query');

      // Get matching profiles
      $profile_ids = DB::table('profile')->where('name', 'LIKE', '%'.$query."%")
      ->orWhere('description', 'LIKE', '%'.$query."%")->get()->pluck('id');

      // Get corresponding communities
      $communities = \App\Community::whereIn('profile_id',$profile_ids)->get();

      // Get corresponding users
      $users = \App\User::whereIn('profile_id',$profile_ids)->get();

      // Get matching Posts
      $posts = Post::where('subject', 'LIKE', '%'.$query."%")
      ->orWhere('body', 'LIKE', '%'.$query."%")->get()->sortByDesc('updated_at');

    }

    $community_thumbnails = '';
    $user_thumbnails = '';
    $post_thumbnails = '';

    foreach($communities as $community) {
      //$community_thumbnails .= '<p>new community</p>';
      $community_thumbnails .= "
      <div class='row' style='padding: 10px'>
        <div class='col-sm-6 col-md-4'>
          <div class='thumbnail shadow'>
            <h3><font color='black'>".$community->profile->name."</font></h3>
            <div class='caption'>
              <p><font color='black'>".$community->profile->description."</font></p>
              <div>
                <form method='GET' action=".route('community.show',$community->id)." accept-charset='UTF-8'>
                <button type='submit' class='btn btn-primary'>Go to community</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      ";
    }
    if ($communities->isEmpty()) {
      $community_thumbnails.="<div class='alert alert-info' role='alert'>
        No matching communities...
      </div>
      ";
    }

    foreach($users as $user) {
      $user_thumbnails .= "
      <div class='row' style='padding: 10px'>
        <div class='col-sm-6 col-md-4'>
          <div class='thumbnail shadow'>
            <h3><font color='black'>".$user->profile->name."</font></h3>
            <div class='caption'>
              <p><font color='black'>".$user->profile->description."</font></p>
              <div>
                <form method='GET' action=".route('user.show',$user->id)." accept-charset='UTF-8'>
                <button type='submit' class='btn btn-primary'>Go to user</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      ";
    }
    if ($users->isEmpty()) {
      $user_thumbnails.="<div class='alert alert-info' role='alert'>
        No matching users...
      </div>
      ";
    }

    foreach($posts as $post) {
      $post_thumbnails .= "
      <div class='row' style='padding: 10px'>
        <div class='col-sm-6 col-md-4'>
          <div class='thumbnail shadow'>
            <h3><font color='black'>".$post->subject."</font></h3>
            <div class='caption'>
              <p><font color='black'>".$post->body."</font></p>
              <div>
                <form method='GET' action=".route('post.show',$post->id)." accept-charset='UTF-8'>
                <button type='submit' class='btn btn-primary'>Go to post</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      ";
    }
    if ($posts->isEmpty()) {
      $post_thumbnails.="<div class='alert alert-info' role='alert'>
        No matching posts...
      </div>
      ";
    }

    Log::info('returning data!');
    return response()->json([
      'community_thumbnails' => $community_thumbnails,
      'user_thumbnails' => $user_thumbnails,
      'post_thumbnails' => $post_thumbnails,
    ]);
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
    //
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
