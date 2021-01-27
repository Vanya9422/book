<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleWorkplaceWorkplaceWebbsiteUrlToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->after('email_verified_at');
            $table->string('workplace_name')->after('title');
            $table->string('workplace_website_url')->after('workplace_name');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('workplace_name');
            $table->dropColumn('workplace_website_url');
        });
    }
}
