<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_eo',191);
            $table->string('foto',50)->nullable();
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('user')->nullable();
            $table->string('alamat',191);
            $table->string('nohp',20);
            $table->string('url_image',50);
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('eo');
    }
}
