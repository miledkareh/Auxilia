<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Name');
            $table->integer('family_id');
            $table->integer('member_id');
            $table->integer('Type');
            $table->double('Amount');
            $table->integer('currency_id');
            $table->text('Notes');
            $table->integer('period_id');
            $table->softDeletes();
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
        Schema::dropIfExists('family_accounts');
    }
}
