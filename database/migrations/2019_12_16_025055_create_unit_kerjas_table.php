<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_kerjas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('instansi_id');
            $table->text('uuid')->nullable();
            $table->string('kode_unit')->length(30);
            $table->string('nama')->length(100);
            $table->text('alamat');
            $table->timestamps();
            $table->foreign('instansi_id')->references('id')->on('instansis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_kerjas');
    }
}
