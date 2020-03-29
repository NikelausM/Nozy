<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
	protected $table = "following";

	protected $fillable = [
			'followingable_id',
			'followingable_type',
			'follower_id',
        ];

    //protected $primaryKey = 'name';
    //public $incrementing = false;
    //public $keyType = 'string';
    public $timestamps = true;

    // Polymorphism: Many types of classes can be followed
    public function followingable() {
			return $this->morphTo();
		}

		// One profile follows a following instance
		public function follower() {
			return $this->hasOne('App\Profile', 'follower_id', 'id');
		}

}
