<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpInfoQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_info_queries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip', 15)->unique();
            $table->string('country_code', 2)->nullable();
            $table->string('region_name')->nullable();
            $table->string('city_name')->nullable();
            $table->float('latitude', 10, 6)->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->string('postal_code')->nullable();
            $table->string('timezone')->nullable();
            $table->string('locality_key')->nullable();
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
        Schema::dropIfExists('ip_info_queries');
    }
}
