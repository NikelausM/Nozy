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

  # post liked
  public function post() {
		return $this->belongsTo('App\Post', 'post_id', 'id');
	}

	# liked by profile
	public function profile() {
		return $this->belongsTo('App\Profile', 'profile_id', 'id');
	}
}
