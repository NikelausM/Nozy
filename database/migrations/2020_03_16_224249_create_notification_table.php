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
            $table->unsignedInteger('notifee_id');
            $table->unsignedInteger('post_id');
            $table->text('notification_type');
            $table->unsignedInteger('profile_id');
            $table->timestamps();
        });

        //Add foreign keys
        Schema::table('notification', function (Blueprint $table) {
          $table->foreign('notifee_id')->references('id')->on('profile')->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('post_id')->references('id')->on('post')->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('profile_id')->references('id')->on('profile')->onUpdate('cascade')->onDelete('cascade');
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
