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
            $table->foreign('usua_id')->references('id')->on('Users');
            $table->integer('preg_id')->unsigned();
            $table->foreign('preg_id')->references('preg_id')->on('Pregunta');
            $table->integer('remu_id')->unsigned()->nullable();
            $table->foreign('remu_id')->references('remu_id')->on('RespuestaMultipleUnica');
            $table->integer('rear_id')->unsigned()->nullable();
            $table->foreign('rear_id')->references('rear_id')->on('RespuestaArchivo');
            $table->text('resp_abierta', 500)->nullable();
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
