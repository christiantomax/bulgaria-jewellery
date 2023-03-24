<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdTrxcosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_trxcos', function (Blueprint $table) {
            $table->id();
            $table->string('IDCO',16);
            $table->foreignId('IDOrderType');
            $table->foreignId('IDCustomer');
            $table->integer('HargaFinal');
            $table->string('Size');
            $table->string('Weight');
            $table->string('MetalType');
            $table->string('Quality');
            $table->string('LaborCost');
            $table->string('GoldPrice');
            $table->string('Note');
            $table->date('TglJatuhTempo')->nullable(true);
            $table->foreignId('IDUser', 8);
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
        Schema::dropIfExists('sd_trxcos');
    }
}
