<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaAbierta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RespuestaAbierta', function (Blueprint $table) {
            $table->increments('reab_id');
            $table->text('reab_textorespuesta' , 500);
            $table->integer('preg_id')->unsigned();
            $table->foreign('preg_id')->references('preg_id')->on('Pregunta');
            $table->string('reab_rutaarchivo', 255);
            $table->timestamp('reab_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('reab_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PucComercial');
    }
}
