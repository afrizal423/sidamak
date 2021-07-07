<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Keluhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluhan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_divisi')->nullable();
            $table->unsignedBigInteger('id_pegawai')->nullable();
            $table->string('nama_pelapor');
            $table->string('keterangan');
            $table->dateTime('tgl_dibuat')->nullable();
            $table->dateTime('tgl_selesai')->nullable();
            $table->longText('solusi')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('is_done_solusi')->default(false);
            $table->boolean('is_approv')->default(false);
            $table->timestamps();

            $table->foreign('id_divisi')->references('id')->on('divisi')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('keluhan');
    }
}
