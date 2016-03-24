<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TraningOfWeeksMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_OfWeeks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_training_detail')->nullable();
            $table->foreign('id_training_detail')->references('id')->on('training_detail')->onDelete('set null');
            $table->integer('numDay');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('training_OfWeeks');
    }
}
