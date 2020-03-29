<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('following', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('followingable_id');
          $table->string('followingable_type');
          $table->unsignedInteger('follower_id');
          $table->timestamps();
        });

        //Add foreign keys
        Schema::table('following', function (Blueprint $table) {
          $table->foreign('follower_id')->references('id')->on('profile')->onUpdate('cascade')->onDelete('cascade');
          //Add unique following constraint
          $table->unique(array('followingable_id', 'followingable_type', 'follower_id'), 'unique_following');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('following');
    }
}
