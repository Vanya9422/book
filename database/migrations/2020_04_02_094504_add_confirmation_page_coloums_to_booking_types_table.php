<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmationPageColoumsToBookingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_types', function (Blueprint $table) {
            $table->string('confirmation_action_type')->after('is_file_upload_enabled');
            $table->string('schedule_another_event_button_text')->after('confirmation_action_type');
            $table->boolean('is_schedule_another_event_button_shown')->after('schedule_another_event_button_text');
            $table->string('external_website_redirect_url')->nullable()->after('is_schedule_another_event_button_shown');
            $table->boolean('pass_event_details_to_redirected_url')->after('external_website_redirect_url');
            
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_types', function (Blueprint $table) {
            //
        });
    }
}
