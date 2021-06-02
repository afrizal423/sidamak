<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_divisi')->nullable();
            $table->unsignedBigInteger('id_unit')->nullable();
            $table->unsignedBigInteger('id_jenis_user')->nullable();
            $table->string('nama_pegawai');
            $table->string('no_hp');
            $table->string('alamat_pegawai');
            $table->timestamps();

            $table->foreign('id_divisi')->references('id')->on('divisi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_unit')->references('id')->on('unit_kerja')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jenis_user')->references('id')->on('jenis_user')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
