<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTallerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Taller', function (Blueprint $table) {
            $table->increments('tall_id');
            $table->string('tall_nombre', 45);
            $table->enum('tall_tipo',['diagnostico','teorico','practico']);
            $table->dateTime('tall_tiempo');
            $table->integer('curs_id')->unsigned();
            $table->foreign('curs_id')->references('curs_id')->on('Curso');
            $table->string('tall_rutaarchivo', 255);
            $table->string('tall_nombrearchivo', 255);
            $table->timestamp('tall_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('tall_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Taller');
    }
}
