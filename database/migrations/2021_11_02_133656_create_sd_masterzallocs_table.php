<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdMasterzallocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_masterzallocs', function (Blueprint $table) {
            $table->id('IDZAlloc');
            $table->string('KodeAlloc',4)->unique();
            $table->string('NamaAlloc',30);
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
        Schema::dropIfExists('sd_masterzallocs');
    }
}
