<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
			$table->increments('id');
            $table->text('email');
            $table->text('age');
            $table->unsignedInteger('profile_id');
            #$table->timestamps();
        });
        
        // Add Foreign key
		Schema::table('user', function (Blueprint $table) {
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
        Schema::dropIfExists('user');
    }
}
