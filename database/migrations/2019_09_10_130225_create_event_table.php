<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto_event',30);
            $table->string('nama_event',191);
            $table->text('deskripsi');
            $table->string('kota',100);
            $table->string('lokasi',191);
            $table->string('kategori',50);
            $table->string('cp',20);
            $table->integer('maksimal');
            $table->unsignedInteger('id_eo');
            $table->foreign('id_eo')->references('id')->on('eo')->nullable();
            $table->integer('status');
            $table->integer('harga')->nullable();
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
        Schema::dropIfExists('event');
    }
}
