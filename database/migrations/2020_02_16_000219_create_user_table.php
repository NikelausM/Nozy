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
            $table->string('name', 250)->primarykey()->unique()->index();
            $table->text('email');
            $table->text('age');
            #$table->timestamps();
        });
        
        // Add Foreign key
		Schema::table('user', function (Blueprint $table) {
			$table->foreign('name')->references('name')->on('profile')->onUpdate('cascade')->onDelete('cascade');
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
