<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateCalificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Calificacion', function (Blueprint $table) {
            $table->increments('cali_id');
            $table->decimal('cali_calificacion', 3, 2);
            $table->decimal('cali_ponderado', 3, 2);
            $table->integer('usua_id')->unsigned();
            $table->foreign('usua_id')->references('usua_id')->on('Usuario');
            $table->integer('tall_id')->unsigned();
            $table->foreign('tall_id')->references('tall_id')->on('Taller');
            $table->integer('preg_id')->unsigned();
            $table->foreign('preg_id')->references('preg_id')->on('Pregunta');
            $table->timestamp('cali_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('cali_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Calificacion');
    }
}
