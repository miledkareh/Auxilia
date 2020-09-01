<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToFamilyMainAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('family_main_accounts', function (Blueprint $table) {
            $table->string('Cheque')->default('');
            $table->string('Bank')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('family_main_accounts', function (Blueprint $table) {
            $table->dropColumn('Cheque');
            $table->dropColumn('Bank');
        });
    }
}
