<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdNoseriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_noseries', function (Blueprint $table) {
            $table->id('IDNos');
            $table->string('KodeToko',2);
            $table->string('KodeNos',5);
            $table->integer('Urutan');
            $table->string('Keterangan');
            $table->date('TanggalMulai');
            $table->date('TanggalAkhir');
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
        Schema::dropIfExists('sd_noseries');
    }
}
