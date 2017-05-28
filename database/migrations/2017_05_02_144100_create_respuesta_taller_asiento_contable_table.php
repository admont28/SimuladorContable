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
            $table->integer('usua_id')->unsigned();
            $table->foreign('usua_id')->references('id')->on('Users');
            $table->integer('taac_id')->unsigned();
            $table->foreign('taac_id')->references('taac_id')->on('TallerAsientoContable');
            $table->integer('rtac_numerotabla');
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
