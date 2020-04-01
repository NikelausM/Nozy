<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Provides data fields and methods to create a PHP data-type representing a User resource in a PHP application.
* @author Nozy team
*
*/
class User extends Profile
{
	/**
	* The name of the table that corresponds to this User
	* @var string
	*/
	protected $table = "user";

	/**
	* The fillable table attributes of this User
	* @var array(string)
	*/
	protected $fillable = [
		'email',
		'age',
		'profile_id',
	];

	//protected $primaryKey = 'name';
	//public $incrementing = false;
	//public $keyType = 'string';
	/**
	* A flag to disable timestamps for Community creations or updates
	* @var array(string)
	*/
	public $timestamps = false;


	/**
	* Retrieve the Profile this User corresponds to
	*
	* @return \App\Profile
	*/
	public function profile() {
		return $this->belongsTo('App\Profile', 'profile_id', 'id');
	}

	/**
	* Retrieve the Communities this User manages
	*
	* @return \App\Profile
	*/
	public function communities() {
		return $this->hasMany('App\Community', 'manager_user_id', 'id');
	}
}
