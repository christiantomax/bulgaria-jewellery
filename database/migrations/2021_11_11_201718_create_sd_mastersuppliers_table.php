<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdMastersuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_mastersuppliers', function (Blueprint $table) {
            $table->id();
            $table->string('IDSupplier',11);
			$table->string('Kode', 3);
			$table->string('Nama');
			$table->string('Telepon', 15);
			$table->string('Telepon2', 15)->nullable();
			$table->string('Email');
			$table->string('Alamat');
			$table->string('Note');
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
        Schema::dropIfExists('sd_mastersuppliers');
    }
}
