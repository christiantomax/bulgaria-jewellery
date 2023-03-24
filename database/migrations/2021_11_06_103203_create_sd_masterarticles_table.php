<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdMasterarticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_masterarticles', function (Blueprint $table) {
            $table->id('IDArticle');
            $table->foreignId('IDSupplier');
            $table->foreignId('IDZAlloc');
            $table->foreignId('IDArticleType');
            $table->string('KodeArticle')->unique();
            $table->string('NamaArticle');
            $table->double('BeratEmas');
            $table->string('Karat');
            $table->double('SellingPrice');
            $table->integer('Block');
            $table->integer('Buyback');
            $table->string('Note');
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
        Schema::dropIfExists('sd_masterarticles');
    }
}
