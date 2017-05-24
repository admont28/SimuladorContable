<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoSituacionFinancieraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EstadoSituacionFinanciera', function (Blueprint $table) {
            $table->increments('essf_id');
            $table->integer('rtni_id')->unsigned();
            $table->foreign('rtni_id')->references('rtni_id')->on('RespuestaTallerNiif');
            $table->integer('essf_efectivoequivalentes');
            $table->integer('essf_deudores');
            $table->integer('essf_anticipoimpuesto');
            $table->integer('essf_inventario');
            $table->integer('essf_activocorriente');
            $table->integer('essf_construccionesedificaciones');
            $table->integer('essf_equiposoficina');
            $table->integer('essf_equipocomputacioncomunicacion');
            $table->integer('essf_flotaequipotransporte');
            $table->integer('essf_activonocorriente');
            $table->integer('essf_totalactivos');
            $table->integer('essf_proveedores');
            $table->integer('essf_retencionfuente');
            $table->integer('essf_retencionaportesnomina');
            $table->integer('essf_acreedoresvarios');
            $table->integer('essf_ivagenerado');
            $table->integer('essf_obligacioneslaborales');
            $table->integer('essf_pasivocorriente');
            $table->integer('essf_obligacionesfinancieras');
            $table->integer('essf_pasivonocorriente');
            $table->integer('essf_totalpasivos');
            $table->integer('essf_aportessociales');
            $table->integer('essf_utilidadejercicio');
            $table->integer('essf_reservasobligatorias');
            $table->integer('essf_totalpatrimonio');
            $table->integer('essf_totalpasivopatrimonio');
            $table->timestamp('essf_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('essf_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('EstadoSituacionFinanciera');
    }
}
