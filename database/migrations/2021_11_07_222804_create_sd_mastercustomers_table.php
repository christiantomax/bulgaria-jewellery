<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdMastercustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_mastercustomers', function (Blueprint $table) {
            $table->id();
            $table->string('IDCustomer',11);
			$table->string('Nama');
			$table->string('Telepon', 15);
			$table->string('Telepon2', 15)->nullable();
			$table->string('Email')->nullable();
			$table->string('Alamat');
			$table->date('TanggalLahir')->nullable();
			$table->string('Note')->nullable();
			$table->foreignId('IDUser', 8);
			$table->string('IDUserUpdated');
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
        Schema::dropIfExists('sd_mastercustomers');
    }
}
