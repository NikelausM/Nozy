<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Provides data fields and methods to create a PHP data-type representing a Following relationship resource in a PHP application.
* @author Nozy team
*
*/
class Following extends Model
{
	/**
	* The name of the table that corresponds to this Following relationship
	* @var string
	*/
	protected $table = "following";

	/**
	* The fillable table attributes of this Following relationship
	* @var array(string)
	*/
	protected $fillable = [
			'followingable_id',
			'followingable_type',
			'follower_id',
        ];

    //protected $primaryKey = 'name';
    //public $incrementing = false;
    //public $keyType = 'string';
		/**
		* A flag to enable timestamps for Following creations or updates
		* @var array(string)
		*/
    public $timestamps = true;

		/**
		* Retrieve the subclass instance able to be followed that this super class corresponds to
		*
		* @return \App\Following
		*/
    public function followingable() {
			return $this->morphTo();
		}

		/**
		* Retrieve the followers of type Profile in this Following relationship
		*
		* @return \App\Profile
		*/
		public function follower() {
			return $this->hasOne('App\Profile', 'follower_id', 'id');
		}

}
