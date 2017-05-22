<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalancePruebaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BalancePrueba', function (Blueprint $table) {
            $table->increments('bapr_id');
            $table->integer('rtni_id')->unsigned();
            $table->foreign('rtni_id')->references('rtni_id')->on('RespuestaTallerNiif');
            $table->string('bapr_codigo', 45);
            $table->string('bapr_cuenta', 45);
            $table->integer('bapr_debito');
            $table->integer('bapr_credito');
            $table->timestamp('bapr_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('bapr_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('BalancePrueba');
    }
}
