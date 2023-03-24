<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdMutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_mutations', function (Blueprint $table) {
            $table->id('IDMutation');
            $table->string('DocumentNo');
            $table->foreignId('IDArticle');
            $table->string('KodeArticle');
            $table->string('NamaArticle');
            $table->foreignId('IDZAllocFrom');
            $table->string('NamaAllocFrom');
            $table->foreignId('IDZAllocTo');
            $table->string('NamaAllocTo');
            $table->foreignId('IDUser');
            $table->string('NamaUser');
            $table->string('Note')->nullable(true);
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
        Schema::dropIfExists('sd_mutations');
    }
}
