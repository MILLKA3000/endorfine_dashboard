<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class OptionsForChapters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options_for_chapters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_options')->nullable();
            $table->foreign('id_options')->references('id')->on('options')->onDelete('set null');
            $table->unsignedInteger('id_chapter')->nullable();
            $table->foreign('id_chapter')->references('id')->on('chapter_list')->onDelete('cascade');
            $table->string('value');
            $table->integer('array_permissions');
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
        Schema::drop('options_for_chapters');
    }
}
