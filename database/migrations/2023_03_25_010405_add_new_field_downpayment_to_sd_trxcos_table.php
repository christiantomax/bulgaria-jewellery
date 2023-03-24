<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldDownpaymentToSdTrxcosTable extends Migration
{
    public function up()
    {
        Schema::table('sd_trxcos', function (Blueprint $table) {
            $table->integer('downpayment');
        });
    }

    public function down()
    {
        Schema::table('sd_trxcos', function (Blueprint $table) {
            $table->dropColumn('downpayment');
        });
    }
}
