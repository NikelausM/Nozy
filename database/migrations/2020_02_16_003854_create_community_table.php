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
            $table->string('name', 250)->primarykey()->unique()->index();
            $table->string('managed_by', 250);    
            #$table->timestamps();
        });
        
        // Add Foreign key
		Schema::table('community', function (Blueprint $table) {
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
        Schema::dropIfExists('community');
    }
}
