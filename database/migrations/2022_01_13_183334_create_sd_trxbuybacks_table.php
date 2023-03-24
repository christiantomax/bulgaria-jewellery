<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdTrxbuybacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_trxbuybacks', function (Blueprint $table) {
            $table->id('IDBuyBack');
            $table->string('KodeBB',20)->unique();
            $table->string('KodeSO',20);
            $table->foreignId('IDUserCreator');
            $table->string('NamaUserCreator');
            $table->string('IDCustomer',11);
            $table->foreignId('IDArticle');
            $table->string('KodeArticle');
            $table->string('NamaArticle');
            $table->double('BeratEmas');
            $table->date('TanggalBB');
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
        Schema::dropIfExists('sd_trxbuybacks');
    }
}
