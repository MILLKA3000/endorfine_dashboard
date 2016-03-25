<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailsTraningForOneDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('name');
            $table->longText('detail');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->unsignedInteger('training_id')->nullable();
            $table->foreign('training_id')->references('id')->on('training_toTrainer')->onDelete('set null');
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
        Schema::drop('calendar_detail');
    }
}
