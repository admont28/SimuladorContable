<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaTallerNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RespuestaTallerNomina', function (Blueprint $table) {
            $table->increments('retn_id');
            $table->integer('tano_id')->unsigned();
            $table->foreign('tano_id')->references('tano_id')->on('TallerNomina');
            $table->integer('usua_id')->unsigned();
            $table->foreign('usua_id')->references('usua_id')->on('Usuario');
            $table->string('retn_nombresyapellidos', 50);
            $table->string('retn_documento', 50);
            $table->integer('retn_diastrabajados');
            $table->integer('retn_salario');
            $table->integer('retn_salariobasico');
            $table->integer('retn_horasextrasyrecargos');
            $table->integer('retn_comisiones');
            $table->integer('retn_bonificaciones');
            $table->integer('retn_totaldevengado');
            $table->integer('retn_auxdetransporte');
            $table->integer('retn_totaldevengadoconauxiliodetransporte');
            $table->integer('retn_salud');
            $table->integer('retn_pension');
            $table->integer('retn_deduccionuno')->nullable();
            $table->integer('retn_deducciondos')->nullable();
            $table->integer('retn_deducciontres')->nullable();
            $table->integer('retn_totaldeducciones');
            $table->integer('retn_netoapagar');
            $table->integer('retn_horaextradiurnacantidad');
            $table->integer('retn_horaextradiurnavalor');
            $table->integer('retn_horaextranocturnacantidad');
            $table->integer('retn_horaextranocturnavalor');
            $table->integer('retn_recargonocturnocantidad');
            $table->integer('retn_recargonocturnovalor');
            $table->integer('retn_horafestivadiurnacantidad');
            $table->integer('retn_horafestivadiurnavalor');
            $table->integer('retn_horafestivanocturnacantidad');
            $table->integer('retn_horafestivanocturnavalor');
            $table->integer('retn_horaextrafestivadiurnacantidad');
            $table->integer('retn_horaextrafestivadiurnavalor');
            $table->integer('retn_horaextrafestivanocturnacantidad');
            $table->integer('retn_horaextrafestivanocturnavalor');
            $table->integer('retn_valortotaldehorasextras');
            $table->string('retn_rutaarchivo', 255)->nullable();
            $table->integer('retn_fila');
            $table->timestamp('retn_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('retn_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RespuestaTallerNomina');
    }
}
