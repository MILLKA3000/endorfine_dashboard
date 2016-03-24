<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientVisitedMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_Visited', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ticket_id')->nullable();
            $table->foreign('ticket_id')->references('id')->on('clientsToTickets')->onDelete('set null');
            $table->unsignedInteger('training_id')->nullable();
            $table->foreign('training_id')->references('id')->on('training_toTrainer')->onDelete('set null');
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
        Schema::drop('client_Visited');
    }
}
