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
            $table->string('essf_efectivoequivalentes', 100);
            $table->string('essf_deudores', 100);
            $table->string('essf_anticipoimpuesto', 100);
            $table->string('essf_inventario', 100);
            $table->string('essf_activocorriente', 100);
            $table->string('essf_construccionesedificaciones', 100);
            $table->string('essf_equiposoficina', 100);
            $table->string('essf_equipocomputacioncomunicacion', 100);
            $table->string('essf_flotaequipotransporte', 100);
            $table->string('essf_activonocorriente', 100);
            $table->string('essf_totalactivos', 100);
            $table->string('essf_proveedores', 100);
            $table->string('essf_retencionfuente', 100);
            $table->string('essf_retencionaportesnomina', 100);
            $table->string('essf_acreedoresvarios', 100);
            $table->string('essf_ivagenerado', 100);
            $table->string('essf_obligacioneslaborales', 100);
            $table->string('essf_impuestossobrelasventasporpagar',100);
            $table->string('essf_pasivocorriente', 100);
            $table->string('essf_obligacionesfinancieras', 100);
            $table->string('essf_pasivonocorriente', 100);
            $table->string('essf_totalpasivos', 100);
            $table->string('essf_aportessociales', 100);
            $table->string('essf_utilidadejercicio', 100);
            $table->string('essf_reservasobligatorias', 100);
            $table->string('essf_totalpatrimonio', 100);
            $table->string('essf_totalpasivopatrimonio', 100);
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
