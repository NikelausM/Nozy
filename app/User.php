<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Profile
{
	protected $table = "user";
	
	protected $fillable = [
			'name',
			'email',
			'password',
			'age',
        ];
    
    protected $primaryKey = 'name';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;
    
    # user extends profile
    public function profile() {
		return $this->belongsTo('App\Profile', 'name', 'name');
	}
}
