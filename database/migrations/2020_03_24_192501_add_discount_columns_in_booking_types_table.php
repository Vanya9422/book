<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountColumnsInBookingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_types', function (Blueprint $table) {
            $table->boolean('is_discount_enabled')->after('rate_currency_code');
            $table->unsignedDecimal('discount_value', 10, 2)->after('is_discount_enabled');
            $table->boolean('discount_has_expiration')->after('discount_value');
            $table->date('discount_expiration_date')->after('discount_has_expiration');
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
            $table->dropColumn('is_discount_enabled');
            $table->dropColumn('discount_value');
            $table->dropColumn('discount_has_expiration');
            $table->dropColumn('discount_expiration_date');
        });
    }
}
