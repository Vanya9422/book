<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->string('name');
            $table->string('short_address');
            $table->string('full_address');
            $table->string('administrative_area_level_2')->nullable();
            $table->string('administrative_area_level_1')->nullable();
            $table->string('country_code', 2);
            $table->string('postal_code')->nullable();
            $table->float('latitude', 10, 6)->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->string('timezone_code');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localities');
    }
}
