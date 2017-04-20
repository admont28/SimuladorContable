<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Respuesta', function (Blueprint $table) {
            $table->increments('resp_id');
            $table->integer('usua_id')->unsigned();
            $table->foreign('usua_id')->references('usua_id')->on('Usuario');
            $table->integer('preg_id')->unsigned();
            $table->foreign('preg_id')->references('preg_id')->on('Pregunta');
            $table->integer('remu_id')->unsigned();
            $table->foreign('remu_id')->references('remu_id')->on('RespuestaMultipleUnica');
            $table->integer('reab_id')->unsigned();
            $table->foreign('reab_id')->references('reab_id')->on('RespuestaAbierta');
            $table->integer('rear_id')->unsigned();
            $table->foreign('rear_id')->references('rear_id')->on('RespuestaArchivo');
            $table->timestamp('resp_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('resp_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Respuesta');
    }
}
