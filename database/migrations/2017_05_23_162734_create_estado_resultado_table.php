<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoResultadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EstadoResultado', function (Blueprint $table) {
            $table->increments('esre_id');
            $table->integer('rtni_id')->unsigned();
            $table->foreign('rtni_id')->references('rtni_id')->on('RespuestaTallerNiif');
            $table->integer('esre_ingresosoperacionales');
            $table->integer('esre_totalingresosoperacionales');
            $table->integer('esre_costoventa');
            $table->integer('esre_utilidadbruta');
            $table->integer('esre_gastospersonal');
            $table->integer('esre_resultadoexplotacion');
            $table->integer('esre_ingresosfinancieros');
            $table->integer('esre_gastosfinancieros');
            $table->integer('esre_utilidadantesimpuestos');
            $table->integer('esre_impuestosobreganancias');
            $table->integer('esre_utilidadliquida');
            $table->integer('esre_reservalegal');
            $table->integer('esre_utilidadnetaejercicio');
            $table->timestamp('esre_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('esre_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('EstadoResultado');
    }
}
