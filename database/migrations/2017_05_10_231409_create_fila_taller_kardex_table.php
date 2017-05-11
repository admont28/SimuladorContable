<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilaTallerKardexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FilaTallerKardex', function (Blueprint $table) {
            $table->increments('fitk_id');
            $table->integer('retk_id')->unsigned();
            $table->foreign('retk_id')->references('retk_id')->on('RespuestaTallerKardex');
            $table->integer('fitk_dia');
            $table->integer('fitk_mes');
            $table->integer('fitk_ano');
            $table->string('fitk_detalle', 100);
            $table->integer('fitk_valorunitario');
            $table->integer('fitk_entradascantidad');
            $table->integer('fitk_entradasvalor');
            $table->integer('fitk_salidascantidad');
            $table->integer('fitk_salidasvalor');
            $table->integer('fitk_saldocantidad');
            $table->integer('fitk_saldovalor');
            $table->integer('fitk_promedio');
            $table->integer('fitk_fila');
            $table->timestamp('fitk_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('fitk_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FilaTallerKardex');
    }
}
