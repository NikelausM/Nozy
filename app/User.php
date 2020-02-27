<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Profile
{
	protected $table = "user";
	
	protected $fillable = [
			'name',
			'email',
			'age',
        ];
    
    protected $primaryKey = 'name';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;
    
    public function getRouteKeyName() {
			return 'name';
	}
    
    # user extends profile
    public function profile() {
		return $this->belongsTo('App\Profile', 'name', 'name');
	}
	
	# user manages community
    public function communities() {
		return $this->hasMany('App\Community', 'name', 'managed_by');
	}

	
}
