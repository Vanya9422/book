<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locality_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('locality_id');
            $table->string('locale', 2);
            $table->string('name');
            $table->string('short_address');
            $table->string('full_address');
            $table->string('administrative_area_level_2')->nullable();
            $table->string('administrative_area_level_1')->nullable();
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
        Schema::dropIfExists('locality_translations');
    }
}
