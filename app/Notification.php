<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Provides data fields and methods to create a PHP data-type representing a Notification resource in a PHP application.
* @author Nozy team
*
*/
class Notification extends Model
{
	/**
	* The name of the table that corresponds to this Notification
	* @var string
	*/
	protected $table = "notification";

	/**
	* The fillable table attributes of this Notification
	* @var array(string)
	*/
	protected $fillable = [
		'following_id',
		'follower_id',
		'message',
	];

	//protected $primaryKey = 'name';
	//public $incrementing = false;
	//public $keyType = 'string';
	/**
	* A flag to enable timestamps for Notification creations or updates
	* @var array(string)
	*/
	public $timestamps = true;

	/**
	* Retrieve the Following relationship that subscribes to this Notification
	*
	* @return \App\Following
	*/
	public function following() {
		return $this->belongsTo('App\Following', 'following_id', 'id');
	}

	/**
	* Retrieve the Profile of the follower that is subscribed to this Notification
	*
	* @return \App\Profile
	*/
	public function follower() {
		return $this->belongsTo('App\Profile', 'follower_id', 'id');
	}
}
