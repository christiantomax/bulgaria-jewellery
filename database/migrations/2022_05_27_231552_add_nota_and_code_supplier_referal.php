<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotaAndCodeSupplierReferal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sd_trxpos', function (Blueprint $table) {
            $table->string('NotaSupplier');
            $table->string('KodeBarangSupplier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sd_trxpos', function (Blueprint $table) {
            $table->dropColumn('NotaSupplier');
            $table->dropColumn('KodeBarangSupplier');
        });
    }
}
