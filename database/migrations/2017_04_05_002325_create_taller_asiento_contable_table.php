<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTallerAsientoContableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TallerAsientoContable', function (Blueprint $table) {
            $table->increments('taac_id');
            $table->integer('taac_cantidadfilas');
            $table->integer('tall_id')->unsigned();
            $table->foreign('tall_id')->references('tall_id')->on('Taller');
            $table->unique('tall_id');
            $table->timestamp('taac_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('taac_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TallerAsientoContable');
    }
}
