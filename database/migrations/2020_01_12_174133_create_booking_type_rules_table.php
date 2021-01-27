<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTypeRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_type_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_type_id');
            $table->string('type'); // WEEK_DAY, DATE
            $table->string('week_day')->nullable();
            $table->date('date')->nullable();
            $table->text('intervals');
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
        Schema::dropIfExists('booking_type_rules');
    }
}
