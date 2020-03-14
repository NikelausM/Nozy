<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Profile extends Authenticatable
{
	
	protected $guard = 'profile';
	
	protected $table = "profile";
	
	protected $fillable = [
           'name',
           'password',
           'description',
    ];
    
    //protected $primaryKey = 'name';
    //public $incrementing = false;
    //public $keyType = 'string';
    public $timestamps = false;
    
    protected $rules = [
		'name' => 'required|unique:profile',
    ];
    
    /*
    public function getRouteKeyName() {
			return 'name';
	}
	*/
	
	public function getAuthPassword() {
		return bcrypt($this->password);
	}
	
	# user manages community
    public function posts() {
		return $this->hasMany('App\Post', 'parent_id', 'id');
	}
}
