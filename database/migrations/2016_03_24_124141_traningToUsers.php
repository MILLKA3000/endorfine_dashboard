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
            $table->unsignedInteger('id_training')->nullable();
            $table->foreign('id_training')->references('id')->on('training_OfWeeks')->onDelete('set null');
            $table->unsignedInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->string('detail');
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
        Schema::drop('training_toTrainer');
    }
}
