<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_followups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Problem')->nullable();
            $table->text('Solution')->nullable();
            $table->timestamp('EndOfTherapy')->nullable();
            $table->string('FamilyTherapy')->nullable();
            $table->timestamp('EndOfFamilyTherapy')->nullable();
            $table->string('Psychologist')->nullable();
            $table->integer('NumberOfVisits')->default(0);
            $table->integer('family_id');
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
        Schema::dropIfExists('family_followups');
    }
}
