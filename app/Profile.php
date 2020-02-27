<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	
	protected $table = "profile";
	
	protected $fillable = [
           'name',
           'password',
           'description',
    ];
    
    protected $primaryKey = 'name';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;
    
    protected $rules = [
		'name' => 'required|unique:profile',
    ];
    
    public function getRouteKeyName() {
			return 'name';
	}
}
