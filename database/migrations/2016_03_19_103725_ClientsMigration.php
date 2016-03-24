<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('discount_id')->nullable();
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('client_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('photo');
            $table->string('birthday');
            $table->string('detail');
            $table->string('note');
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('client_statuses')->onDelete('set null');
            $table->integer('enabled');
            $table->timestamps();
            $table->softDeletes(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('client_info');
        Schema::drop('client_statuses');
    }
}
