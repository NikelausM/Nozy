<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	
	protected $table = "post";
	
	protected $fillable = [
			'title',
			'rating',
			'description',
			'parent_id',
        ];
        
    # user extends profile
    public function profile() {
		return $this->belongsTo('App\Profile', 'parent_id', 'id');
	}
}
