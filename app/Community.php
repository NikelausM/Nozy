<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
	
	protected $table = "community";
	
	protected $fillable = [
           'email',
           'password',
        ];
}
