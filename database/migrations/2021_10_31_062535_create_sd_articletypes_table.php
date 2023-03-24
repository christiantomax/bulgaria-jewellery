<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdArticletypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_articletypes', function (Blueprint $table) {
            $table->id('IDArticleType');
            $table->string('KodeAwal',3)->unique();
            $table->string('NamaJenisArticle',30);
            $table->string('Note');
            $table->integer('IDUser');
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
        Schema::dropIfExists('sd_articletypes');
    }
}
