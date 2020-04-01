<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Provides data fields and methods to create a PHP data-type representing a Community resource in a PHP application.
* @author Nozy team
*
*/
class Community extends Profile
{

	/**
	* The name of the table that corresponds to this Community
	* @var string
	*/
	protected $table = "community";

	/**
	* The fillable table attributes of this Community
	* @var array(string)
	*/
	protected $fillable = [
		'profile_id',
		'manager_user_id',
	];
	//protected $primaryKey = 'name';
	//public $incrementing = false;
	//public $keyType = 'string';
	//
	/**
	* A flag to disable timestamps for Community creations or updates
	* @var array(string)
	*/
	public $timestamps = false;

	/**
	* Retrieve the Profile this Community corresponds to
	*
	* @return \App\Profile
	*/
	public function profile() {
		return $this->belongsTo('App\Profile', 'profile_id', 'id');
	}

	/**
	* Retrieve the User this Community managed by
	*
	* @return \App\User
	*/
	public function user() {
		return $this->belongsTo('App\User', 'manager_user_id', 'id');
	}

}
