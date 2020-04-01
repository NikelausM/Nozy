<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
* Provides data fields and methods to create a PHP data-type representing a Profile resource in a PHP application.
* @author Nozy team
*
*/
class Profile extends Authenticatable
{

	/**
	* The guard used to access the currently logged in (authenticated) user.
	* Laravel assumes the website uses a User class only for authentication,
	* thus a guard is necessary to specify the Profile class as being the main
	* authentication class.
	* @var string
	*/
	protected $guard = 'profile';

	/**
	* The name of the table that corresponds to this Profile
	* @var string
	*/
	protected $table = "profile";

	/**
	* The fillable table attributes of this Profile
	* @var array(string)
	*/
	protected $fillable = [
		'name',
		'password',
		'description',
	];

	//protected $primaryKey = 'name';
	//public $incrementing = false;
	//public $keyType = 'string';
	/**
	* A flag to disable timestamps for Community creations or updates
	* @var array(string)
	*/
	public $timestamps = false;

	protected $rules = [
		'name' => 'required|unique:profile',
	];

	/**
	* Retrieve the password of this Profile
	*
	* @return string
	*/
	public function getAuthPassword() {
		return bcrypt($this->password);
	}

	/**
	* Retrieve the Posts on this Profile
	*
	* @return \App\Post
	*/
	public function posts() {
		return $this->hasMany('App\Post', 'posted_on_profile_id', 'id');
	}

	/**
	* Retrieve the Posts created by this Profile
	*
	* @return \App\Post
	*/
	public function postsCreated() {
		return $this->hasMany('App\Post', 'posted_by_profile_id', 'id');
	}

	/**
	* Retrieve the Likes and Dislikes corresponding to this Profile
	*
	* @return \App\LikeDislike
	*/
	public function likesdislikes() {
		return $this->hasMany('App\LikeDislike', 'profile_id', 'id');
	}

	/**
	* Retrieve the Following followingable relationships corresponding to this Profile
	*
	* @return \App\Following
	*/
	public function followings() {
		return $this->morphMany('App\Following', 'followingable');
	}

	/**
	* Retrieve the Following follower relationships corresponding to this Profile
	*
	* @return \App\Following
	*/
	public function follower() {
		return $this->hasOne('App\Following', 'follower_id', 'id');
	}

	/**
	* Retrieve the Notifications corresponding to this Profile
	*
	* @return \App\Notification
	*/
	public function notifications() {
		return $this->hasMany('App\Notification', 'follower_id', 'id');
	}

}
