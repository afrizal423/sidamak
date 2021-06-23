<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KeluhanPic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluhan_pegawai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_keluhan')->nullable();
            $table->unsignedBigInteger('id_pegawai')->nullable();
            $table->timestamps();

            $table->foreign('id_keluhan')->references('id')->on('keluhan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pegawai')->references('id')->on('pegawai')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keluhan_pegawai');
    }
}
