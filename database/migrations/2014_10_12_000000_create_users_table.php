<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intro_step')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('auth_method')->nullable();
            $table->string('password')->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('locality_key')->nullable();
            $table->string('locale', 2);
            $table->string('date_format'); // AMERICAN, EUROPEAN
            $table->string('time_format'); // 12H, 24H
            $table->unsignedBigInteger('own_organization_id');
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
