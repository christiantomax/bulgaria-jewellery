<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdTrxcoimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_trxcoimages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IDCO');
            $table->string('Name')->nullable();
            $table->string('Path')->nullable();
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
        Schema::dropIfExists('sd_trxcoimages');
    }
}
