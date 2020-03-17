<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
	protected $table = "following";

	protected $fillable = [
			'follower_id',
			'followee_id',
			'type',
        ];

    //protected $primaryKey = 'name';
    //public $incrementing = false;
    //public $keyType = 'string';
    public $timestamps = false;

    # user get follower
    public function follower() {
			return $this->belongsTo('App\Profile', 'follower_id', 'id');
		}

		public function followee() {
			return $this->belongsTo('App\Profile', 'followee_id', 'id');
		}
}
