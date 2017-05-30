<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilaTallerNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FilaTallerNomina', function (Blueprint $table) {
            $table->increments('fitn_id');
            $table->integer('retn_id')->unsigned();
            $table->foreign('retn_id')->references('retn_id')->on('RespuestaTallerNomina');
            $table->string('fitn_nombresyapellidos', 50);
            $table->string('fitn_documento', 50);
            $table->integer('fitn_diastrabajados');
            $table->integer('fitn_salario');
            $table->integer('fitn_salariobasico');
            $table->integer('fitn_horasextrasyrecargos');
            $table->integer('fitn_comisiones');
            $table->integer('fitn_bonificaciones');
            $table->integer('fitn_totaldevengado');
            $table->integer('fitn_auxdetransporte');
            $table->integer('fitn_totaldevengadoconauxiliodetransporte');
            $table->integer('fitn_salud');
            $table->integer('fitn_pension');
            $table->integer('fitn_deduccionuno')->nullable();
            $table->integer('fitn_deducciondos')->nullable();
            $table->integer('fitn_deducciontres')->nullable();
            $table->integer('fitn_totaldeducciones');
            $table->integer('fitn_netoapagar');
            $table->integer('fitn_horaextradiurnacantidad');
            $table->integer('fitn_horaextradiurnavalor');
            $table->integer('fitn_horaextranocturnacantidad');
            $table->integer('fitn_horaextranocturnavalor');
            $table->integer('fitn_recargonocturnocantidad');
            $table->integer('fitn_recargonocturnovalor');
            $table->integer('fitn_horafestivadiurnacantidad');
            $table->integer('fitn_horafestivadiurnavalor');
            $table->integer('fitn_horafestivanocturnacantidad');
            $table->integer('fitn_horafestivanocturnavalor');
            $table->integer('fitn_horaextrafestivadiurnacantidad');
            $table->integer('fitn_horaextrafestivadiurnavalor');
            $table->integer('fitn_horaextrafestivanocturnacantidad');
            $table->integer('fitn_horaextrafestivanocturnavalor');
            $table->integer('fitn_valortotaldehorasextras');
            $table->integer('fitn_fila');
            $table->timestamp('fitn_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('fitn_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FilaTallerNomina');
    }
}
