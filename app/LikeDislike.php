<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Provides data fields and methods to create a PHP data-type representing a Like/Dislike resource in a PHP application.
* @author Nozy team
*
*/
class LikeDislike extends Model
{
	/**
	* The name of the table that corresponds to a Like or Dislike
	* @var string
	*/
	protected $table = "likedislike";

	/**
	* The fillable table attributes of this LikeDislike
	* @var array(string)
	*/
	protected $fillable = [
		'type',
		'post_id', // post liked/disliked
		'profile_id', // profile that liked/disliked post
	];

	/**
	* Retrieve the Profile this LikeDislike corresponds to
	*
	* @return \App\Post
	*/
	public function post() {
		return $this->belongsTo('App\Post', 'post_id', 'id');
	}

	/**
	* Retrieve the Profile this LikeDislike corresponds to
	*
	* @return \App\Profile
	*/
	public function profile() {
		return $this->belongsTo('App\Profile', 'profile_id', 'id');
	}
}
