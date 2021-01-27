<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTypeQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_type_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_type_id');
            $table->string('title');
            $table->string('answer_type');
            $table->text('answer_options')->nullable();
            $table->boolean('other_option_allowed');
            $table->unsignedSmallInteger('position');
            $table->boolean('is_required');
            $table->boolean('is_enabled');
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
        Schema::dropIfExists('booking_type_questions');
    }
}
