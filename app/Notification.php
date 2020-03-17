<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $table = "notification";

	protected $fillable = [
			'notifee_id',
			'post_id',
      'notification_type',
      'profile_id',
        ];

    //protected $primaryKey = 'name';
    //public $incrementing = false;
    //public $keyType = 'string';
    public $timestamps = true;

		# notification belongs to notifee
		public function notifee() {
		return $this->belongsTo('App\Profile', 'notifee_id', 'id');
		}

    # notification belongs to profile
    public function profile() {
		return $this->belongsTo('App\Profile', 'profile_id', 'id');
		}

    # notification belongs to post
    public function post() {
      return $this->belongsTo("App\Post", "post_id", 'id');
    }



}
