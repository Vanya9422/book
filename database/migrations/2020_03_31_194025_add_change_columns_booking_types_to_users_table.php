<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeColumnsBookingTypesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_types', function (Blueprint $table) {
            $table->dropColumn('is_payment_required');
            $table->string('payment_type')->after('internal_note');
            $table->unsignedDecimal('rate_value', 10, 2)->nullable()->change();
        });
        
        Schema::table('booking_types', function (Blueprint $table) {
            $table->renameColumn('rate_value', 'hourly_rate_value');
            $table->renameColumn('rate_currency_code', 'hourly_rate_currency_code');
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
            $table->renameColumn('hourly_rate_value', 'rate_value');
            $table->renameColumn('hourly_rate_currency_code', 'rate_currency_code');
        });
        
        Schema::table('booking_types', function (Blueprint $table) {
            $table->dropColumn('payment_type');
            $table->boolean('is_payment_required')->after('internal_note');;
            $table->unsignedDecimal('rate_value', 10, 2)->change();
        });
    }
}
