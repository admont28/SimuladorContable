<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaTallerNiifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RespuestaTallerNiif', function (Blueprint $table) {
            $table->increments('rtni_id');
            $table->integer('tani_id')->unsigned();
            $table->foreign('tani_id')->references('tani_id')->on('TallerNiif');
            $table->integer('usua_id')->unsigned();
            $table->foreign('usua_id')->references('id')->on('Users');
            $table->integer('rear_id')->unsigned()->nullable();
            $table->foreign('rear_id')->references('rear_id')->on('RespuestaArchivo');
            $table->timestamp('rtni_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('rtni_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RespuestaTallerNiif');
    }
}
