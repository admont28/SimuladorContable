<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaArchivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RespuestaArchivo', function (Blueprint $table) {
            $table->increments('rear_id');
            $table->string('rear_rutaarchivo' , 255);
            $table->string('rear_nombre', 100);
            $table->timestamp('rear_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('rear_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RespuestaArchivo');
    }
}
