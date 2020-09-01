<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyMainAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_main_accounts', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('family_id');
          
            $table->text('Notes');
            $table->double('Amount');
            $table->integer('currency_id');
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
        Schema::dropIfExists('family_main_accounts');
    }
}
