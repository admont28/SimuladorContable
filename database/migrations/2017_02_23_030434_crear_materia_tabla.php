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
        Schema::create('materia', function (Blueprint $table) {
          $table->increments('mate_id');
          $table->string('tema_nombre', 100);
          $table->longText('tema_tema', 500);
          $table->integer('curs_id')->unsigned();
          $table->foreign('curs_id')->references('id')->on('curso');
          $table->timestamp('usua_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->timestamp('usua_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materia');
    }
}
