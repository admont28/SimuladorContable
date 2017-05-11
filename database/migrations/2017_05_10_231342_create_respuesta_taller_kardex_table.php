<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaTallerKardexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RespuestaTallerKardex', function (Blueprint $table) {
            $table->increments('retk_id');
            $table->integer('taka_id')->unsigned();
            $table->foreign('taka_id')->references('taka_id')->on('TallerKardex');
            $table->integer('usua_id')->unsigned();
            $table->foreign('usua_id')->references('usua_id')->on('Usuario');
            $table->integer('rear_id')->unsigned()->nullable();
            $table->foreign('rear_id')->references('rear_id')->on('RespuestaArchivo');
            $table->string('retk_articulo',100);
            $table->string('retk_direccion',100);
            $table->string('retk_proveedores',100);
            $table->timestamp('retk_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('retk_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RespuestaTallerKardex');
    }
}
