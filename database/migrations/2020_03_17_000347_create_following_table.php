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
            $table->unsignedInteger('follower_id');
            $table->unsignedInteger('followee_id');
            $table->text('type');
        });

        //Add foreign keys
        Schema::table('following', function (Blueprint $table) {
          $table->foreign('follower_id')->references('id')->on('profile')->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('followee_id')->references('id')->on('profile')->onUpdate('cascade')->onDelete('cascade');

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
