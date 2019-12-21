<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('unit_kerja_id');
            $table->text('uuid')->nullable();
            $table->string('NIP')->length('25');
            $table->string('tempat_lahir')->length(255);
            $table->date('tanggal_lahir');
            $table->string('alamat')->length(255);
            $table->string('jk')->length(25);
            $table->string('agama')->length(25);
            $table->string('status_pegawai')->length(25);
            $table->string('status_kawin')->length(25);
            $table->string('golongan_darah')->length(5);
            $table->foreign('unit_kerja_id')->references('id')->on('unit_kerjas')->onDelete('cascade');
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
        Schema::dropIfExists('karyawans');
    }
}
