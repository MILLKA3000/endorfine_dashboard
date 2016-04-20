<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermissionsRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_role', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_role')->nullable();
            $table->foreign('id_role')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('permissions_tag');
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
        Schema::drop('permissions_role');
    }
}
