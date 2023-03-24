<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdTrxsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_trxsos', function (Blueprint $table) {
            $table->id('IDSO');
            $table->string('KodeSO',20)->unique();
            $table->string('KodeBB',20);
            $table->foreignId('IDUserCreator');
            $table->foreignId('IDUserUpdater');
            $table->string('NamaUserCreator');
            $table->string('NamaUserUpdater');
            $table->string('IDCustomer',11);
            $table->foreignId('IDArticle');
            $table->string('KodeArticle');
            $table->string('NamaArticle');
            $table->double('BeratEmas');
            $table->date('TanggalSO');
            $table->string('Karat');
            $table->double('Harga');
            $table->double('HargaFinal');
            $table->string('Note');
            $table->integer('Status');
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
        Schema::dropIfExists('sd_trxsos');
    }
}
