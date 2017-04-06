<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTallerNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TallerNomina', function (Blueprint $table) {
            $table->increments('tano_id');
            $table->integer('tano_cantidadfilas');
            $table->string('tano_deduccionprestamo',50);
            $table->string('tano_deduccion2',50);
            $table->string('tano_deduccion3',50);
            $table->integer('tall_id')->unsigned();
            $table->foreign('tall_id')->references('tall_id')->on('Taller');
            $table->unique('tall_id');
            $table->timestamp('tano_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('tano_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TallerNomina');
    }
}
