<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaTallerNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RespuestaTallerNomina', function (Blueprint $table) {
            $table->increments('retn_id');
            $table->integer('tano_id')->unsigned();
            $table->foreign('tano_id')->references('tano_id')->on('TallerNomina');
            $table->integer('usua_id')->unsigned();
            $table->foreign('usua_id')->references('id')->on('Users');
            $table->integer('rear_id')->unsigned()->nullable();
            $table->foreign('rear_id')->references('rear_id')->on('RespuestaArchivo');
            $table->timestamp('retn_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('retn_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RespuestaTallerNomina');
    }
}
