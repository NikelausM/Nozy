<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
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
    
    # community extends profile
    public function profile() {
		return $this->belongsTo('App\Profile', 'name', 'name');
	}
}
