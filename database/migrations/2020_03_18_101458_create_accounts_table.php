<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Ref');
            $table->double('Allocation');
            $table->double('Medicale');
            $table->double('Scolaire');
            $table->double('Divers');
            $table->double('Debit');
            $table->double('cDebit');
            $table->integer('currency_id');
            $table->string('Bank');
            $table->string('PaymentMode');
            $table->text('Notes');
            $table->integer('sponsor_id');
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
        Schema::dropIfExists('accounts');
    }
}
