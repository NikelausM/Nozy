<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class Community extends Profile
=======
class Community extends Model
>>>>>>> 1b24e720e2ea410517dcb083c4adfa83f571f070
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
    
<<<<<<< HEAD
	public function getRouteKeyName() {
			return 'name';
	}
    
=======
>>>>>>> 1b24e720e2ea410517dcb083c4adfa83f571f070
    # community extends profile
    public function profile() {
		return $this->belongsTo('App\Profile', 'name', 'name');
	}
<<<<<<< HEAD
	
	# community managed by user
    public function communities() {
		return $this->hasOne('App\User', 'managed_by', 'name');
	}
	

=======
>>>>>>> 1b24e720e2ea410517dcb083c4adfa83f571f070
}
