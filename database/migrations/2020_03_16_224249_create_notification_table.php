<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('following_id');
          $table->unsignedInteger('follower_id');
          $table->timestamps();
        });

        //Add foreign keys
        Schema::table('notification', function (Blueprint $table) {
          $table->foreign('following_id')->references('id')->on('following')->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('follower_id')->references('id')->on('profile')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification');
    }
}
