<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaTallerAsientoContableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RespuestaTallerAsientoContable', function (Blueprint $table) {
            $table->increments('rtac_id');
            $table->integer('taac_id')->unsigned();
            $table->foreign('taac_id')->references('taac_id')->on('TallerAsientoContable');
            $table->integer('usua_id')->unsigned();
            $table->foreign('usua_id')->references('usua_id')->on('Usuario');
            $table->integer('puc_id')->unsigned();
            $table->foreign('puc_id')->references('puc_id')->on('Puc');
            $table->integer('rtac_valordebito');
            $table->integer('rtac_valorcredito');
            $table->timestamp('rtac_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('rtac_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RespuestaTallerAsientoContable');
    }
}
