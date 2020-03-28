<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $table = "notification";

	protected $fillable = [
			'following_id',
			'follower_id',
        ];

    //protected $primaryKey = 'name';
    //public $incrementing = false;
    //public $keyType = 'string';
    public $timestamps = true;

		# Polymorphism: Many types  of classes can create notifications
		public function following() {
			return $this->belongsTo('App\Following', 'following_id', 'id');
		}

    // Individual notifications belong to individual profiles
    public function follower() {
			return $this->belongsTo('App\Profile', 'follower_id', 'id');
		}
}
