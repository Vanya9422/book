<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPortfolioEnabledToBookingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_types', function (Blueprint $table) {
            $table->boolean('is_portfolio_enabled')->after('discount_expiration_date');
            $table->boolean('is_file_upload_enabled')->after('is_portfolio_enabled');
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
            $table->dropColumn('is_portfolio_enabled');
            $table->dropColumn('is_file_upload_enabled');
        });
    }
}
