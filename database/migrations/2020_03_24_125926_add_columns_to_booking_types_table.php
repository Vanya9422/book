<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBookingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_types', function (Blueprint $table) {
            $table->boolean('is_payment_required')->after('internal_note');
            $table->unsignedDecimal('rate_value', 10, 2)->after('is_payment_required');
            $table->string('rate_currency_code', 3)->after('rate_value');
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
            $table->dropColumn('is_payment_required');
            $table->dropColumn('rate_value');
            $table->dropColumn('rate_currency_code');
        });
    }
}
