<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTallerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Taller', function (Blueprint $table) {
            $table->increments('talle_id');
            $table->string('talle_nombre', 45);
            $table->enum('talle_tipo',['diagnostico','teorico','practico']);
            $table->dateTime('talle_tiempo');
            $table->integer('curs_id')->unsigned();
            $table->foreign('curs_id')->references('curs_id')->on('Curso');
            $table->string('talle_rutaarchivo', 255);
            $table->timestamp('talle_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('talle_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taller');
    }
}
