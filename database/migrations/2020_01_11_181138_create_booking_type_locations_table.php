<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTypeLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_type_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_type_id')->index();
            $table->string('type');
            $table->string('basic_information')->nullable();
            $table->text('additional_information')->nullable();
            $table->string('call_type')->nullable();
            $table->boolean('is_hidden');
            $table->unsignedDecimal('position', 65, 30);
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
        Schema::dropIfExists('booking_type_locations');
    }
}
