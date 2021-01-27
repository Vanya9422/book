<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_booking_page_id')->nullable();
            $table->unsignedBigInteger('owner_user_id');
            $table->unsignedBigInteger('assigned_user_id');
            $table->string('slug')->index();
            $table->string('title')->nullable();
            $table->boolean('use_user_name_as_title');
            $table->boolean('use_user_avatar_as_user_avatar');
            $table->text('welcome_message');
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
        Schema::dropIfExists('booking_pages');
    }
}
