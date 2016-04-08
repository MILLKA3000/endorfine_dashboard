<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JoinTrainersToRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter_trainer_to_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('chapter_rooms')->onDelete('cascade');
            $table->unsignedInteger('trainer_id')->nullable();
            $table->foreign('trainer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('room_calendar_id');
            $table->string('note');
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
        Schema::drop('chapter_trainer_to_rooms');
    }
}
