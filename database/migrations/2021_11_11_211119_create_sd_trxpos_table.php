<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdTrxposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_trxpos', function (Blueprint $table) {
            $table->id();
            $table->string('IDPO',16);
            $table->foreignId('IDSupplier');
            $table->foreignId('IDArticle');
            $table->integer('Harga');
            $table->integer('ExchangeRate');
            $table->date('TglJatuhTempo')->nullable(true);
  			$table->string('Note');
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
        Schema::dropIfExists('sd_trxpos');
    }
}
