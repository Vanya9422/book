<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDurationTypeInBookingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_types', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->text('durations')->after('period_type');
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
            $table->dropColumn('durations');
            $table->integer('duration')->after('period_type');
        });
    }
}
