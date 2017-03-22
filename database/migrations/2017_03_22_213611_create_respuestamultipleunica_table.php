<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestamultipleunicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RespuestaMultipleUnica', function (Blueprint $table) {
            $table->increments('remu_id');
            $table->text('remu_texto' , 200);
            $table->boolean('remu_correcta');
            $table->integer('preg_id')->unsigned();
            $table->foreign('preg_id')->references('preg_id')->on('Pregunta');

            $table->timestamp('remu_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('remu_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RespuestaMultipleUnica');
    }
}
