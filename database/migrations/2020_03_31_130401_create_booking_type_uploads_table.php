<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTypeUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_type_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_type_id');
            $table->string('upload_box_text');
            $table->string('upload_box_description');
            $table->string('title');
            $table->string('description');
            $table->boolean('is_enabled');
            $table->boolean('is_required');
            $table->unsignedSmallInteger('position');
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
        Schema::dropIfExists('booking_type_uploads');
    }
}
