<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTemaTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tema', function (Blueprint $table) {
            $table->increments('tema_id');
            $table->string('tema_titulo', 100);
            $table->string('tema_rutaarchivo', 100);
            $table->integer('curs_id')->unsigned();
            $table->foreign('curs_id')->references('curs_id')->on('curso');
            $table->timestamp('tema_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('tema_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tema');
    }
}
