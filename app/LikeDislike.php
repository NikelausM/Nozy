<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{

	protected $table = "likedislike";

	protected $fillable = [
			'type',
			'post_id', // post liked/disliked
			'profile_id', // profile that liked/disliked post
        ];

  # posted on profile
  public function posts() {
		return $this->hasMany('App\Post', 'post_id', 'id');
	}

	# posted by profile
	public function profiles() {
		return $this->hasMany('App\Profile', 'profile_id', 'id');
	}
}
