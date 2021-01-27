<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameTableFromBookingTypeRulesToBookingTypeAvailabilityRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('booking_type_rules', 'booking_type_availability_rules');
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('booking_type_availability_rules', 'booking_type_rules');
    }
}
