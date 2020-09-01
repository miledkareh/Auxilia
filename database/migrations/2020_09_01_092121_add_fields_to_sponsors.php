<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSponsors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->integer('Coordinateur')->default(0);
            $table->string('Encaisseur')->nullable();
            $table->string('SouhaitsDuDonateur')->nullable();
            $table->timestamp('FirstPaymentDate')->nullable();
            $table->string('Delegue')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->dropColumn('Coordinateur');
            $table->dropColumn('Encaisseur');
            $table->dropColumn('SouhaitsDuDonateur');
            $table->dropColumn('FirstPaymentDate');
            $table->dropColumn('Delegue');
        });
    }
}
