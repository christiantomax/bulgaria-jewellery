<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_agendas', function (Blueprint $table) {
            $table->id();
            $table->string('IDAgenda',16);
            $table->date('TglMulai');
            $table->string('JudulAgenda',30);
            $table->string('NoteAgenda');
            $table->boolean('Status');
			$table->string('Note')->nullable();
            $table->foreignId('IDUser');
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
        Schema::dropIfExists('sd_agendas');
    }
}
