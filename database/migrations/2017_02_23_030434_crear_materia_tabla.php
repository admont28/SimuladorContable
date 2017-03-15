<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearMateriaTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Materia', function (Blueprint $table) {
          $table->increments('mate_id');
          $table->string('mate_nombre', 100);
          $table->longText('mate_tema', 1000);
          $table->string('mate_rutaarchivo', 255);
          $table->integer('curs_id')->unsigned();
          $table->foreign('curs_id')->references('curs_id')->on('Curso');
          $table->timestamp('mate_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->timestamp('mate_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Materia');
    }
}
