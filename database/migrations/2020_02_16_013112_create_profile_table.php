<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
			$table->string('email', 250)->primarykey()->unique();
            $table->string('name', 250)->unique();
            $table->text('description');
            #$table->timestamps();
        });
        
        // Add Foreign key
		Schema::table('profile', function (Blueprint $table) {
			$table->foreign('email')->references('email')->on('user')->onUpdate('cascade')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
