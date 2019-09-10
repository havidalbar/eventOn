<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomentarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->unsignedInteger('id_event');
            $table->foreign('id_event')->references('id')->on('event');
            $table->text('isi');
            $table->unsignedInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('user');
            $table->unsignedInteger('id_eo')->nullable();
            $table->foreign('id_eo')->references('id')->on('eo')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('komentar');
    }
}
