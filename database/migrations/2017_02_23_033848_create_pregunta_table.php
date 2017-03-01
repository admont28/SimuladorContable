<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pregunta', function (Blueprint $table) {
            $table->increments('preg_id');
            $table->text('preg_texto' , 500);
            $table->enum('preg_tipo', ['multiple','unica','abierta','archivo']);
            $table->decimal('preg_porcentaje', 2, 1);
            $table->integer('tall_id')->unsigned();
            $table->foreign('tall_id')->references('tall_id')->on('Taller');


            $table->timestamp('preg_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('preg_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pregunta');
    }
}
