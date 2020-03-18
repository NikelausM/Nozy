<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->integer('rating');
            $table->text('body');
            $table->unsignedInteger('posted_on_profile_id');
            $table->unsignedInteger('posted_by_profile_id');
            $table->timestamps();
        });

        // Add Foreign key
		Schema::table('post', function (Blueprint $table) {
			$table->foreign('posted_on_profile_id')->references('id')->on('profile')->onUpdate('cascade')->onDelete('cascade');
		});

    // Add Foreign key
  Schema::table('post', function (Blueprint $table) {
    $table->foreign('posted_by_profile_id')->references('id')->on('profile')->onUpdate('cascade')->onDelete('cascade');
  });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
