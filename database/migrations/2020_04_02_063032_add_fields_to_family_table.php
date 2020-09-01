<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('families', function (Blueprint $table) {
            $table->string('FamilyName')->nullable();
            $table->timestamp('Date')->nullable();
            $table->string('Place')->nullable();
            $table->string('Street')->nullable();
            $table->string('Building')->nullable();
            $table->string('Floor')->nullable();
            $table->string('RelativeName')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('families', function (Blueprint $table) {
            $table->dropColumn('FamilyName');
            $table->dropColumn('Date');
            $table->dropColumn('Place');
            $table->dropColumn('Street');
            $table->dropColumn('Building');
            $table->dropColumn('Floor');
            $table->dropColumn('RelativeName');
        });
    }
}
