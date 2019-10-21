<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_event');
            $table->foreign('id_event')->references('id')->on('event')->nullable();
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('user')->nullable();
            $table->unsignedInteger('id_booking');
            $table->foreign('id_booking')->references('id')->on('booking')->nullable();
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
        Schema::dropIfExists('peserta');
    }
}
