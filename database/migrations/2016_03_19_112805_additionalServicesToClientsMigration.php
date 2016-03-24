<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdditionalServicesToClientsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additionalServices_ToClients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('client_info')->onDelete('set null');
            $table->unsignedInteger('service_id')->nullable();
            $table->foreign('service_id')->references('id')->on('additionalServices_Type')->onDelete('set null');
            $table->date('endDateForUse');
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
        Schema::drop('additionalServices_ToClients');
    }
}
