<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleAutocompleteQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_autocomplete_queries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('input');
            $table->string('types')->nullable();
            $table->string('components')->nullable();
            $table->string('language')->nullable();
            $table->text('predictions');
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
        Schema::dropIfExists('google_autocomplete_queries');
    }
}
