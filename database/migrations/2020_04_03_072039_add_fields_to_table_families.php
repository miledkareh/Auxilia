<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTableFamilies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('families', function (Blueprint $table) {
            $table->string('LevelOfStudy');
            $table->boolean('DrivingLicense')->default(false);
            $table->boolean('Car')->default(false);
            $table->string('CompanyName')->nullable();
            $table->string('CompanyLocation')->nullable();
            $table->string('PaymentMode')->nullable();
            $table->string('HealthCare')->nullable();
            $table->string('HomeProperty')->nullable();
            $table->string('NumberOfRooms')->nullable();
            $table->string('LivingRoom')->nullable();
            $table->string('Kitchen')->nullable();
            $table->string('Bathroom')->nullable();
            $table->string('State')->nullable();
            $table->text('Remarks')->nullable();
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
            $table->dropColumn('LevelOfStudy');
            $table->dropColumn('DrivingLicense');
            $table->dropColumn('Car');
            $table->dropColumn('CompanyName');
            $table->dropColumn('CompanyLocation');
            $table->dropColumn('PaymentMode');
            $table->dropColumn('HealthCare');
            $table->dropColumn('HomeProperty');
            $table->dropColumn('NumberOfRooms');
            $table->dropColumn('LivingRoom');
            $table->dropColumn('Kitchen');
            $table->dropColumn('Bathroom');
            $table->dropColumn('State');
            $table->dropColumn('Remarks');
        });
    }
}
