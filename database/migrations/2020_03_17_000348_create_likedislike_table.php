<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeDislikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likedislike', function (Blueprint $table) {
            $table->increments('id');
            $table->text('type'); // "like" or "dislike"
            $table->unsignedInteger('post_id'); // post liked or disliked
            $table->unsignedInteger('profile_id'); // profile that liked or disliked post
            $table->timestamps();
        });

        //Add foreign keys
        Schema::table('likedislike', function (Blueprint $table) {
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
        Schema::dropIfExists('likedislike');
    }
}
