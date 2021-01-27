<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_page_id')->index();
            $table->boolean('is_template');
            $table->string('type'); // SINGLE (One-to-One), GROUP
            $table->string('slug');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('locale', 2);
            $table->string('period_type'); // MOVING, FIXED, UNLIMITED
            $table->unsignedSmallInteger('duration'); // in minutes
            $table->string('color', 6); // in hex
            $table->tinyInteger('max_invitees')->nullable();
            $table->string('timezone_code')->nullable();
            $table->string('timezone_type'); // LOCAL, LOCKED
            $table->unsignedInteger('max_bookings_per_day')->nullable();
            $table->unsignedInteger('min_booking_time'); // in seconds
            $table->unsignedInteger('max_booking_time'); // in seconds
            $table->unsignedSmallInteger('buffer_before'); // in minutes
            $table->unsignedSmallInteger('buffer_after'); // in minutes
            $table->unsignedSmallInteger('spot_step'); // in minutes
            $table->boolean('autofill_invitee_information');
            $table->boolean('allow_invitees_to_add_guests');
            $table->string('invitee_name_format'); // COMBINED, SEPARATED
            $table->boolean('is_cancellation_allowed');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_public');
            $table->boolean('is_active');
            $table->text('internal_note');
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
        Schema::dropIfExists('booking_types');
    }
}
