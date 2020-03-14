<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Profile
{
	
	protected $table = "community";
	
	protected $fillable = [
           'profile_id',
           'manager_user_id',
        ];
    //protected $primaryKey = 'name';
    //public $incrementing = false;
    //public $keyType = 'string';
    public $timestamps = false;
    
    /*
	public function getRouteKeyName() {
			return 'name';
	}
	*/
    
    # community extends profile
    public function profile() {
		return $this->belongsTo('App\Profile', 'profile_id', 'id');
	}
	
	# user managing community
    public function user() {
		return $this->belongsTo('App\User', 'manager_user_id', 'id');
	}
	
}
