<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilaTallerAsientoContableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FilaTallerAsientoContable', function (Blueprint $table) {
            $table->increments('ftac_id');
            $table->integer('rtac_id')->unsigned();
            $table->foreign('rtac_id')->references('rtac_id')->on('RespuestaTallerAsientoContable');
            $table->integer('puc_id')->unsigned();
            $table->foreign('puc_id')->references('puc_id')->on('Puc');
            $table->integer('ftac_valordebito');
            $table->integer('ftac_valorcredito');
            $table->integer('ftac_fila');
            $table->timestamp('ftac_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('ftac_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FilaTallerAsientoContable');
    }
}
