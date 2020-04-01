<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Provides data fields and methods to create a PHP data-type representing a Post resource in a PHP application.
* @author Nozy team
*
*/
class Post extends Model
{

	/**
	* The name of the table that corresponds to this Post
	* @var string
	*/
	protected $table = "post";

	/**
	* The fillable table attributes of this Post
	* @var array(string)
	*/
	protected $fillable = [
		'subject',
		'rating',
		'body',
		'posted_on_profile_id',
		'posted_by_profile_id',
	];

	/**
	* The model's default values for attributes.
	*
	* @var array
	*/
	protected $attributes = [
		'rating' => 0,
	];

	/**
	* Retrieve the Profile this Post was posted on
	*
	* @return \App\Profile
	*/
	public function posted_on_profile() {
		return $this->belongsTo('App\Profile', 'posted_on_profile_id', 'id');
	}

	/**
	* Retrieve the Profile this Post was posted by
	*
	* @return \App\Profile
	*/
	public function posted_by_profile() {
		return $this->belongsTo('App\Profile', 'posted_by_profile_id', 'id');
	}

	/**
	* Retrieve the Likes and Dislikes of this Post
	*
	* @return \App\LikeDislike
	*/
	public function likesdislikes() {
		return $this->hasMany('App\LikeDislike', 'post_id', 'id');
	}

	/**
	* Retrieve the Following relationships that subscribe to this Post
	*
	* @return \App\Following
	*/
	public function followings() {
		return $this->morphMany('App\Following', 'followingable');
	}

}
