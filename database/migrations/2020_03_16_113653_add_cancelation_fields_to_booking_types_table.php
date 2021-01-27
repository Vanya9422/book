<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCancelationFieldsToBookingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_types', function (Blueprint $table) {
            $table->string('notification_type')->after('invitee_name_format'); // CALENDAR_INVITATION, EMAIL_CONFIRMATION
            $table->text('cancellation_policy_text')->after('is_cancellation_allowed');
            $table->boolean('is_invitee_reminder_enabled')->after('cancellation_policy_text');
            $table->boolean('is_invitee_sms_reminder_enabled')->after('is_invitee_reminder_enabled');
            $table->boolean('is_invitee_email_follow_up_enabled')->after('is_invitee_sms_reminder_enabled');
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
            $table->dropColumn('notification_type');
            $table->dropColumn('cancellation_policy_text');
            $table->dropColumn('is_invitee_reminder_enabled');
            $table->dropColumn('is_invitee_sms_reminder_enabled');
            $table->dropColumn('is_invitee_email_follow_up_enabled');
        });
    }
}
