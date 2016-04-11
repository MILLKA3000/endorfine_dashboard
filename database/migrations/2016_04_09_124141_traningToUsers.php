<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TraningToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_toTrainer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_events');
            $table->unsignedInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedInteger('id_trainer_to_rooms')->nullable();
            $table->foreign('id_trainer_to_rooms')->references('id')->on('chapter_trainer_to_rooms')->onDelete('set null');
            $table->string('note');
            $table->dateTime('start');
            $table->dateTime('end');
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
        Schema::drop('training_toTrainer');
    }
}
