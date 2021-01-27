<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTypeAppearancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_type_appearances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_type_id');
            $table->boolean('is_main_photo_enabled');
            $table->string('page_type');
            $table->string('page_title');
            $table->string('page_header');
            $table->string('body_text');
            $table->string('footer_text');
            $table->string('main_button_text');
            $table->string('main_button_color');
            $table->string('main_button_text_color');
            $table->string('main_text_color');
            $table->string('main_font');
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
        Schema::dropIfExists('booking_type_appearances');
    }
}
