<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangementDeclarationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changement_declarations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('changement_id');
            $table->integer('family_id');
            $table->text('Remarks')->nullable();
            $table->timestamp('Date')->nullable();
            $table->string('Type')->nullable();
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
        Schema::dropIfExists('changement_declarations');
    }
}
