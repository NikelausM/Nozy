<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Profile
{
	
	protected $table = "community";
	
	protected $fillable = [
           'name',
           'managed_by',
        ];
    protected $primaryKey = 'name';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;
    
	public function getRouteKeyName() {
			return 'name';
	}
    
    # community extends profile
    public function profile() {
		return $this->belongsTo('App\Profile', 'name', 'name');
	}
	
	# community managed by user
    public function communities() {
		return $this->hasOne('App\User', 'managed_by', 'name');
	}
	

}
