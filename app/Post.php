<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $table = "post";

	protected $fillable = [
			'subject',
			'rating',
			'body',
			'posted_on_profile_id',
			'posted_by_profile_id',
        ];

	/**
	* The model's default values for attributes.
	*
	* @var array
	*/
	protected $attributes = [
			'rating' => 0,
        ];

    # posted on profile
    public function posted_on_profile() {
		return $this->belongsTo('App\Profile', 'posted_on_profile_id', 'id');
	}

	# posted by profile
	public function posted_by_profile() {
		return $this->belongsTo('App\Profile', 'posted_by_profile_id', 'id');
	}

	# posted by profile
	public function likesdislikes() {
		return $this->hasMany('App\LikeDislike', 'post_id', 'id');
	}
}
