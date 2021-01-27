<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_page_id')->index();
            $table->string('type'); // PAYPAL, PAYONEER, BANK_ACCOUNT
            $table->string('bank_account_type')->nullable(); // PERSONAL, BUSINESS
            $table->string('payment_email');
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->string('aba_routing_number')->nullable();
            $table->string('transit_branch_number')->nullable();
            $table->text('bank_address')->nullable();
            $table->string('country_code', 2)->index()->nullable();
            $table->string('currency_code', 3)->index()->nullable();
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
        Schema::dropIfExists('payout_methods');
    }
}
