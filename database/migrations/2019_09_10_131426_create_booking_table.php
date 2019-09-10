<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama',191);
            $table->string('nohp',20);
            $table->string('alamat',191);
            $table->string('email',191)->unique();
            $table->string('kode_booking',6)->nullable();
            $table->string('norek',20)->nullable();
            $table->string('bank_pengirim',20)->nullable();
            $table->string('bank_tujuan',20)->nullable();
            $table->bigInteger('jumlah');
            $table->integer('kode_unik');
            $table->string('gambar_konfirmasi')->nullable();
            $table->integer('status')->default('0');
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('user')->nullable();
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
        Schema::dropIfExists('booking');
    }
}
