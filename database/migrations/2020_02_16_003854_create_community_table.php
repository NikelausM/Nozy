<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('profile_id');
            $table->unsignedInteger('manager_user_id');
            #$table->timestamps();
        });
        
        // Add Foreign key
		Schema::table('community', function (Blueprint $table) {
			$table->foreign('profile_id')->references('id')->on('profile')->onUpdate('cascade')->onDelete('cascade');
		});
		
		Schema::table('community', function (Blueprint $table) {
			$table->foreign('manager_user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community');
    }
}
