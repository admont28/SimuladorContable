<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tarifa', function (Blueprint $table) {
            $table->increments('tari_id');
            $table->string('tari_nombre', 100);
            $table->string('tari_valor', 30);
            $table->integer('tall_id')->unsigned();
            $table->foreign('tall_id')->references('tall_id')->on('Taller');
            $table->timestamp('tari_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('tari_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tarifa');
    }
}
